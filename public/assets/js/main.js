window.addEventListener('load', ()=> {
    $link = document.querySelectorAll('.nav a');
    $link.forEach(element => {
        element.addEventListener('click', (e)=> {
            $link.forEach(es => {
                es.classList.remove('active');
            });
            e.target.classList.add('active');
        })
    });
})
