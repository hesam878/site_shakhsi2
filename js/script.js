const namefull=$("#namefull");
const email=$("#email");
const payam=$("#payam");
const sm_namefull=$('#sm_namefull');
const sm_email=$('#sm_email');
const sm_payam=$('#sm_payam');
const year=$('#year');
const project=$('#project');
const rezaiat=$('#rezaiat');

fetch("http://localhost:5000/api/data")
  .then(res => res.json())
  .then(data => console.log(data));

// setTimeout(() => {
//     for (let i=0; i < 3; i++){
//         console.log(i);
//             year.text(i);
//     }
// }, 2000);

let start_year=0;
let start_project=0;
let start_rezaiat=0;
let end_year=1;
let end_project=40;
let end_rezaiat=100;
let all_time=10000;
let end_time_year=all_time/end_year;
let end_time_project=all_time/end_project;
let end_time_rezaiat=all_time/end_rezaiat;

function adad(){
    console.log(start_rezaiat);
    year.text(start_year + '+')
    project.text(start_project + '+')
    rezaiat.text(start_rezaiat + '%')
    if (start_year < end_year){
        start_year++;
        setTimeout(adad,end_time_year);
    }    
    if (start_project < end_project){
        start_project++;
        setTimeout(adad,end_time_project);
    }
    if (start_rezaiat < end_rezaiat){
        start_rezaiat++;
        setTimeout(adad,end_time_rezaiat);
    }
}
// adad();

window.$('nav').scroll(function (){
    if (window.scrollY > 50){
        $('nav').css('background-color: rgba(255, 255, 255, 0.7);')
        $('nav').css.backdropFilter('blur: 5px;')
    }else{
        $('nav').css('background-color: rgba(255, 255, 255);')
        $('nav').css.backdropFilter('blur: 0px;')
    }
});

function btn(){
    $('.natije').hide()
}

let noerror=true;
function error(){

        if (namefull.val().length==0){
            sm_namefull.text('!پر کردن این فیلد اجباری است');
             noerror=false;
        }else if(!/^[\u0600-\u06FF\s]+$/.test(namefull.val())){
            sm_namefull.text('!نام و نام خانوادگی حتما باید فارسی و بدون هیچ علامت یا عددی وارد شود');
             noerror=false;
        }else if (namefull.val().length<5){
            sm_namefull.text('!نام و نام خانوادگی باید بیش از 5 حرف باشد');
             noerror=false;
        }else{
            noerror = true;
             sm_namefull.text('');
        }


        if (payam.val().length == 0) {
            sm_payam.text('!پر کردن این فیلد اجباری است');
            noerror = false;
        }
        else if (payam.val().length < 10) {
            sm_payam.text('!متن پیام باید حداقل ۱۰ کاراکتر باشد');
            noerror = false;
        }
        else {
            noerror = true;
            sm_payam.text('');
        }        

        
        if (email.val().length == 0) {
            sm_email.text('!پر کردن این فیلد اجباری است');
            noerror = false;
        }
        else if (!/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/.test(email.val())) {
            sm_email.text('!ایمیل وارد شده معتبر نمی‌باشد');
            noerror = false;
        }
        else {
            noerror = true;
            sm_email.text('');
        }
        
        return noerror;
}

namefull.on('click keyup',error);
email.on('click keyup',error);
payam.on('click keyup',error);

// console.log(noerror);

let fullPath = window.location.pathname;
// console.log("مسیر کامل صفحه:", fullPath);

let fileName = fullPath.split('/').pop();
// console.log("نام فایل صفحه:", fileName);

$("#form").on('submit' , function (e) {
    e.preventDefault();
    if (noerror == false){
        console.log(noerror);
        return
    }
    $.ajax({
        url:'php/ajax.php',
        type:'POST',
        data:{
            namefull:namefull.val(),
            email:email.val(),
            payam:payam.val(),
            filename:fileName
        },
        success:function (response){
            console.log('ok');
            namefull.val('');
            email.val('');
            payam.val('');
            $('.natije').css('display', 'flex');
        },
        error:function (xhr,status,error){
            console.log(error)
            $('.natije').css('display', 'flex');
            $('.natije h4').text('پیام شما ارسال نشد!');
            $('.natije img').attr('src','image/cross-vermeia.gif');
            $('.natije button').text('تلاش مجدد')
        }
    });
});