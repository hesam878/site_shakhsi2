document.querySelectorAll('.btn-filter').forEach(button => {
    // console.log(button) 
    button.addEventListener('click', function() {
        document.querySelectorAll('.btn-filter').forEach(btn => btn.classList.remove('active'));
        this.classList.add('active');
        
        const filter = this.getAttribute('data-filter');
        const projects = document.querySelectorAll('.project-card');
        let ai =false
        projects.forEach(project => {
            // console.log(project)
            if (filter === 'all' || project.getAttribute('data-category') === filter) {
                project.style.display = 'block';
            }
            else if (filter === 'ai' || project.getAttribute('data-category') === filter) {
                console.log('ok')
                project.style.display = 'none';
                ai=true
            }
        }); 
        // let ai_html=[]
        if (ai){
            const ai=document.querySelectorAll('.ai');
                ai.forEach(ai2=>{
                    document.getElementById('body_projects').innerHTML=ai2;
                    // ai2.style.display = 'inline-block';
                    // ai2.classList.add('col-4');
                });
            // console.log(ai_html)
            // for (let i=0;i<2;i++){
            //     console.log(i)
            //     document.getElementById('body_projects').innerHTML=ai_html[i]
            // }
        }
    });
});

// const active=document.querySelectorAll('.data-filter');

// if (active && active.classList.contains('active')){
//     console.log('yes');
// }else{
//     console.log('no');
// }

// const spans=document.querySelectorAll('.body_projects .col span');
// spans.forEach(span=>{
//     console.log(span.textContent);
// });
