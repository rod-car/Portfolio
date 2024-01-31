document.addEventListener('DOMContentLoaded', e => {

    const dropdownBtn = document.getElementById('dropdown-button')
    const menu = document.querySelector('.nav-ul')

    const skills = document.getElementById('skills')
    const skillsSection = document.getElementById('skills-section')

    const projects = document.getElementById('projects')
    const projectsSection = document.getElementById('projects-section')

    skills?.addEventListener('click', ce => {
        ce.preventDefault()

        skillsSection.scrollIntoView({
            behavior: 'smooth'
        })

        if (window.innerWidth <= 580) menu.style.display = 'none'
    })

    projects?.addEventListener('click', ce => {
        ce.preventDefault()

        projectsSection.scrollIntoView({
            behavior: 'smooth'
        })

        if (window.innerWidth <= 580) menu.style.display = 'none'
    })

    dropdownBtn?.addEventListener('click', ce => {
        ce.preventDefault()
        if (menu.style.display == 'flex') {
            menu.style.display = 'none'
            dropdownBtn.classList.remove('hover')
        } else {
            menu.style.display = 'flex'
            dropdownBtn.classList.add('hover')
        }
    })

})