const btn_all=document.getElementById('btn_all')
const all=document.querySelectorAll('.all');
const btn_ai=document.getElementById('btn_ai');
const ai=document.getElementById('ai');
const btn_ui=document.getElementById('btn_ui');
const ui=document.getElementById('ui');
const btn_logo=document.getElementById('btn_logo');
const logo=document.getElementById('logo');
const btn_bot=document.getElementById('btn_bot');
const bot=document.getElementById('bot');
const btn_full_project=document.getElementById('btn_full_project');
btn_full_project.style.display='none';

btn_all.addEventListener('click', function(){
    ai.style.display='none';
    ui.style.display='none';
    logo.style.display='none';
    bot.style.display='none';
    all.forEach(card_all=>{
        card_all.style.display='block'
    });
});

btn_ai.addEventListener('click', function(){
    all.forEach(card_all=>{
        card_all.style.display='none'
    });
    ai.style.display='block';
    ui.style.display='none';
    logo.style.display='none';
    bot.style.display='none';
    btn_full_project.style.display='none';
});

btn_ui.addEventListener('click', function(){
    all.forEach(card_all=>{
        card_all.style.display='none'
    });
    ai.style.display='none';
    logo.style.display='none';
    bot.style.display='none';
    ui.style.display='block';
    btn_full_project.style.display='none';
});

btn_logo.addEventListener('click', function(){
    all.forEach(card_all=>{
        card_all.style.display='none'
    });
    ai.style.display='none';
    ui.style.display='none';
    bot.style.display='none';
    logo.style.display='block';
    btn_full_project.style.display='none';
});

btn_bot.addEventListener('click', function(){
    all.forEach(card_all=>{
        card_all.style.display='none'
    });
    ai.style.display='none';
    ui.style.display='none';
    logo.style.display='none';
    bot.style.display='block';
    btn_full_project.style.display='none';
});
document.querySelectorAll('.btn-filter').forEach(button => {
    button.addEventListener('click', function() {
        document.querySelectorAll('.btn-filter').forEach(btn => btn.classList.remove('active'));
        this.classList.add('active');
    });
});