var answer = '';

function logincheck(){
	$.ajax({
		type: 'POST',
		url: "login.php",//url of receiver file on server
		data: $("#login").serializeObject(), //your data
		dataType: "text", //text/json...
		success: function(xhr, response, options){
			if(xhr == 'success'){
				$('#crosswordBox').removeClass("hide");
				$('#loginBox').attr("class", "hide");
				$('#crosswordBox').attr("class", "show");
				return true;
				
			} else {
				$('#loginError').html(xhr);
				return false;
			};
					
					
		},
		error:function(xhr, response, options){
			$('#loginError').html(response)
			return false;
		} //callback when ajax request finishes

});
	
}

var generate = function(){

	$('#crosswordBox').removeClass("show");
	$('#crosswordBox').addClass("hide");
	
	var question = document.getElementById('grid_ques').value;
	var file_data = question.split('\n');

	for (i = 0; i<file_data.length; i++){
		cross_data[i] = file_data[i].split(',');
	}

	//console.log("length : " + cross_data.length)

	for (j = 0; j<cross_data.length; j++){
		clues[j] = cross_data[j][0];
		words[j] = cross_data[j][1].trim();

	}

	// Create crossword object with the words and clues
	var cw = new Crossword(words, clues);

	// create the crossword grid (try to make it have a 1:1 width to height ratio in 10 tries)
	var tries = 10; 
	var grid = cw.getSquareGrid(tries);

	// report a problem with the words in the crossword
	if(grid == null){
		var bad_words = cw.getBadWords();
		var str = [];
		for(var i = 0; i < bad_words.length; i++){
			str.push(bad_words[i].word);
		}
		alert("Shoot! A grid could not be created with these words:\n" + str.join("\n"));
		return;
	}

	// turn the crossword grid into HTML
	//var show_answers = true;
	document.getElementById("crossword").innerHTML = CrosswordUtils.toHtml(grid);

	// make a nice legend for the clues
	var legend = cw.getLegend(grid);
	addLegendToPage(legend);
	
	$('#puzzleBox').removeClass("hide");
	$('#puzzleBox').addClass("show");
}

function addLegendToPage(groups){
    for(var k in groups){
        var html = [];
        for(var i = 0; i < groups[k].length; i++){
            html.push("<li><strong>" + groups[k][i]['position'] + ".</strong> " + groups[k][i]['clue'] + "</li>");
        }
        document.getElementById(k).innerHTML = html.join("\n");
    }
}

function sample(){
	document.getElementById('grid_ques').value = 'this is my test ques 1,ans1\nthis is my test ques 2,ans2\nthis is my test ques 3,ans3\nthis is my test ques 4,ans4'
} 

function download(){
	write_ans();
	var data = '<form id="crossword_form" name="crossword_form"><div id="clock">Time:<input type="text" id="minutes" class="clock-box" value="00" readonly></label>:<input type="text" class="clock-box" id="seconds" value="00" readonly></label></div>' + document.getElementById('crossword_box').innerHTML + '<div class="text-center"><button type="button" class="btn btn-lg btn-info" id="submit_quiz" name="submit_quiz" onclick="check_answer()">Submit Puzzle</button></div></form><hr>' + document.getElementById('clue_box').innerHTML;
	generate_page(data);
	
	
}

function write_ans(){

	$.ajax({
	  type: 'POST',
	  url: "root/answer.php",//url of receiver file on server
	  data: stored_chars, //your data
	  dataType: "text", //text/json...
	  success: function(xhr, response, options){
					return true;
                },
                error:function(xhr, response, options){
					return false;
                } //callback when ajax request finishes
	  
	});
}

function generate_page(data){
	$.ajax({
		type: 'POST',
		url: "download.php",//url of receiver file on server
		data: data, //your data
		dataType: "text", //text/json...
		success: function(xhr, response, jqXHR){
			$('#created_url').html(xhr);
			return true;
					
		},
		error:function(xhr, response, options){
			return false;
		} //callback when ajax request finishes
	  
	});
}

function check_answer(){
    var data_array = $("#crossword_form").serializeObject();
    read_answer_file(data_array);
	
}

function read_answer_file(data_array){
    $.ajax({
        url: "root/answer_read.php",
        dataType:"json",
        success: function(resp){
            stored_chars = resp;
            checkData(data_array, stored_chars);
            var data =  "\nEmp Id: " + empId + " Score: " + score + " Time: " + document.getElementById("minutes").value + ':'+ document.getElementById("seconds").value;
            writeFile(data);
            retVal = confirm("Your score is : " + score + '\nPlease click on OK button to close the window');
            if( retVal == true ){
                window.close();
            }
            else{
                location.reload();
            }

        }
    });
}

function checkData(data_array, stored_chars){
    score = 0;
    var input = Object.getOwnPropertyNames(data_array);
    var store = Object.getOwnPropertyNames(stored_chars);
    if(input.length = store.length){
        for (var i = 0; i < input.length; i++) {
            var data = input[i];
            if (data_array[data].toUpperCase() === stored_chars[data].toUpperCase()){
                score++;
            }
        }
    }
}

function writeFile(data){
	
	$.ajax({
		type: 'POST',
		url: "root/result.php",//url of receiver file on server
		data: data, //your data
		dataType: "text", //text/json...
		success: function(xhr, response, jqXHR){
			return true;		
		},
		error:function(xhr, response, options){
			return false;
		} //callback when ajax request finishes
	  
	});
}
$.fn.serializeObject = function()
{
    var o = {};
    var a = this.serializeArray();
    $.each(a, function() {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};
