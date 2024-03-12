const form = document.querySelector(".typing-area"), //typing-area class
inputField = form.querySelector(".input-field"), //input-fields
sendBtn = form.querySelector("button"); //button
chatBox = document.querySelector(".chat-box"); //chat-box class

form.onsubmit = (e)=>{
    e.preventDefault(); //preventing form from submitting
}

sendBtn.onclick = ()=>{ //function when send button is clicked
    let xhr = new XMLHttpRequest();//creating XML object
    xhr.open("POST", "php/insert-chat.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
            inputField.value = ""; //once message inserted into database input field will become blank
            scrollToBottom();
          }
      }
    }
    //we have to send the form data through ajax to php
    let formData = new FormData(form);//creating new formData Object
    xhr.send(formData);//sending the form data to php
}

chatBox.onmouseenter = ()=>{
  chatBox.classList.add("active");
}

chatBox.onmouseleave = ()=>{
  chatBox.classList.remove("active");
}

setInterval(() =>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/get-chat.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
            let data = xhr.response;
            chatBox.innerHTML = data;
            if(!chatBox.classList.contains("active")){
              scrollToBottom();
            }
          }
      }
    }
    let formData = new FormData(form);//creating new formData Object
    xhr.send(formData);//sending the form data to php
  }, 500); //this function will run frequently after 500ms
  
function scrollToBottom(){
    chatBox.scrollTop = chatBox.scrollHeight;
}

  
  