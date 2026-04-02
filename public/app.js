
let show=document.querySelector('.show_password');
let hidden=document.querySelector('.hidden');
let password=document.querySelector('#password');
show.addEventListener('click',()=>{
     password.type="text";
    show.style.visibility="hidden";
    hidden.style.visibility="visible";


});
hidden.addEventListener('click',function(){
  password.type="password";
   show.style.visibility="visible";
    hidden.style.visibility="hidden";
});

// confirm input targeting
let confirm=document.querySelector("#password_confirmation");
let checkbox=document.querySelector('.checkbox');
let checkbox1=document.querySelector('.checkbox1');
checkbox.addEventListener('click',function(){
    confirm.type="text";
    this.style.visibility="hidden";
   checkbox1.style.visibility="visible";
});
checkbox1.addEventListener('click',function(){
   confirm.type="password";
   this.style.visibility="hidden";
   checkbox.style.visibility="visible";
});

