<!doctype html>
<html>
<head>
 
   <meta name="robots" content="noindex,nofollow">
   <title>AJAX Pet Adoption Agency</title>
   <style>
      @import url('https://fonts.googleapis.com/css2?family=Smokum&display=swap');
      @import url('https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap');
      
     #myForm div{
      margin-bottom:2%;
      }  
      /*changes font and font size and highlights the pet name in the output*/
      .petName {
        font-family: 'Smokum', cursive;
        font-size: 25px;
        background-color: #ccc;
      }
     
     .fontS {
       font-family: 'Permanent Marker', cursive;
       font-size: 15px;
     }

     body {
       margin-left: 1.5em;
     }
     
   </style>
   <script src="https://code.jquery.com/jquery-latest.js"></script>
</head>
<body>
<h2>AJAX Pet Adoption Agency</h2>
<div id="output">
<p>This is an AJAX-based form, which gives the user a series of 3 radio questions and a textbox that prompts the user to name their pet. There is a different pet for every possible combination, so feel free to play around! These questions appear one at a time, and the data is transmitted to a server-side page via AJAX. This project uses the jQuery library (i.e. .get(), .done(), .fail()) for processing and transmitting the data.</p>
<p>Choose below to pick a pet:</p>
<form id="myForm" action="" method="get">
   <div id="pet_feels">
       <h3>Feels</h3>
       <p>Please choose how you would like your pet to feel:</p>
       <input type="radio" name="feels" value="fluffy" required="required">fluffy <br />
       <input type="radio" name="feels" value="scaly">scaly <br />
   </div>
   <div id="pet_likes">
       <h3>Likes</h3>
       <p>Please tell us what your pet will like:</p>
       <input type="radio" name="likes" value="petted" required="required">to be petted <br />
       <input type="radio" name="likes" value="ridden">to be ridden <br />
   </div>
    <div id="pet_eats">
       <h3>Eats</h3>
       <p>Please tell us what your pet likes to eat:</p>
       <input type="radio" name="eats" value="carrots" required="required">carrots <br />
       <input type="radio" name="eats" value="pets">other people's pets <br />
   </div>
   <div id="pet_name">
       <h3>Name</h3>
       <p>Please name your pet:</p>
       <input type="text" name="petName" placeholder="Name" required="required" />
   </div>
  
   <div><input type="submit" value="submit it!" /></div>
</form>
</div>
<p><a href="index.php">RESET</a></p>
<script>
    //titleCase function
    function titleCase(str){
      str = str.toLowerCase().split(' ');
      for (var i = 0; i < str.length; i++) {
        str[i] = str[i].charAt(0).toUpperCase() + str[i].slice(1);
      }
      return str.join(' ');
    };
  
    $("document").ready(function(){
        
        //hide likes and eats
        $('#pet_likes').hide();
        $('#pet_eats').hide();
        $('#pet_name').hide();
      
        //click feels and show likes
        $('#pet_feels').click(function(e){
          $('#pet_likes').slideDown(200);
        });
        //click likes and show eats
        $('#pet_likes').click(function(e){
          $('#pet_eats').slideDown(200);
        });
        //click eats and show name
        $('#pet_eats').click(function(e){
          $('#pet_name').slideDown(200);
        });
               
        $('#myForm').submit(function(e){ //.submit is an event handler, just like .click
            e.preventDefault();//no need to submit as you'll be doing AJAX on this page
            let feels = $("input[name=feels]:checked").val();
            let likes = $("input[name=likes]:checked").val();
            let eats = $("input[name=eats]:checked").val();
            let petName = $("input[name=petName]:contains()").val()
            let pet = "ERROR";
            var output = ""; //a string that will capture all the information from AJAX page and from the form
            //135
            if(feels == "fluffy" && likes == "petted" && eats == "carrots"){
              pet = "bermese";
            }//136
            else if(feels == "fluffy" && likes == "petted" && eats == "pets"){
              pet = "bad-dog";
            }//145
            else if(feels == "fluffy" && likes == "ridden" && eats == "carrots"){
              pet = "golden";
            }//146
            else if(feels == "fluffy" && likes == "ridden" && eats == "pets"){
              pet = "bulldog";
            }//235
            else if(feels == "scaly" && likes == "petted" && eats == "carrots"){
              pet = "bird";
            }//236
            else if(feels == "scaly" && likes == "petted" && eats == "pets"){
              pet = "hedgehog";
            }//245
            else if(feels == "scaly" && likes == "ridden" && eats == "carrots"){
              pet = "tortie-kitten";
            }//246
            else if(feels == "scaly" && likes == "ridden" && eats == "pets"){
              pet = "velociraptor";
            }
            //this titleCases the output of the name of the pet that the user inputted. <span class = "fontS"></span>
            petName = titleCase(petName);
            //the span class is created here, so that we can refer to it in the <style> tag for css
            output += `<p>Meet <span class="petName">${petName}</span>! <br><span class = "fontS">${petName}</span> is a <span class = "fontS">${feels}</span>  <span class = "fontS">${pet}</span> that likes to be <span class = "fontS">${likes}</span>. <br>Their favorite food is <span class = "fontS">${eats}</span> so make sure to stock up on it!</p> <p>Have fun with your new ${pet}!!</p>`
            /*
            output += `<p>Your pet's name is ${petName}.</p>`;
            output += `<p>Your pet is a ${pet}.</p>`;
            output += `<p>Your pet feels ${feels}.</p>`;
            output += `<p>Your pet likes to be ${likes}.</p>`;
            output += `<p>Your pet likes to eat ${eats}.</p>`;
           */
            //alert(feels);
            
            $.get( "includes/get_pet.php", { critter: pet } )
               .done(function( data ) {
                 //alert( "Data Loaded: " + data );
                 
                 //output submitted info and replace form
                 $('#output').html(data + output);
                 
               })
              .fail(function(xhr, status, error) {
               //Ajax request failed.
               var errorMessage = xhr.status + ': ' + xhr.statusText
               alert('Error - ' + errorMessage); //404 is "file not found"
               });
                       
        });
    });
   </script>
</body>
</html>