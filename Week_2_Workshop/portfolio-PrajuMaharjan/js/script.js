function shownavbar(){
const toggle=document.getElementById("menu-toggle");

const navigation_bar=document.getElementById("navigation");
	console.log("Clicked");
	if(navigation_bar.style.left==="0px"){
		navigation_bar.style.left="-700px";
	}
else{
	navigation_bar.style.left="0px";
}};

window.addEventListener("resize",function(){
  const navigation_bar = document.getElementById("navigation");
  if (window.innerWidth>1025) {
    navigation_bar.classList.add("active");
  } else {
    navigation_bar.classList.remove("active");
  }
});

function form_checker(event){
	event.preventDefault();
  const name=document.getElementById("Name");
  const email=document.getElementById("Email");
  const message=document.getElementById("Message");

  let isValid=true;

  if (name.value.trim()==="") {
    alert("Name field is empty.");
    isValid=false;
  }
  
  const emailPattern=/^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!emailPattern.test(email.value.trim())){
    alert("Email field is invalid");
    isValid=false;
  }

  if (message.value.trim() === "") {
    alert("Message field is empty");
    isValid=false;
  }
  if (isValid){
  alert("Thank you for the message");
  name.value="";
  email.value="";
  message.value="";
}
}