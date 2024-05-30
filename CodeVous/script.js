document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('add-education').addEventListener('click', addEducation);
    document.getElementById('add-project').addEventListener('click', addProject);
    document.getElementById('generate-cv').addEventListener('click', generateCV);
    document.getElementById('import-xml').addEventListener('click', importXMLData);
    document.getElementById('upload-photo').addEventListener('change', updateProfilePicture);
});

function updateProfileName() {
    const nameInput = document.getElementById('name');
    const nameText = document.getElementById('profile-name-text');
    nameText.textContent = nameInput.value;
}

function updateProfilePicture(event) {
    const profilePicture = document.getElementById('profile-picture');
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = (e) => {
            profilePicture.src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
}

function addEducation() {
    const educationList = document.getElementById('education-list');
    const educationDiv = document.createElement('div');
    educationDiv.classList.add('education-entry');

    educationDiv.innerHTML = `
        <label for="degree">Diplôme :</label>
        <input type="text" name="degree" placeholder="Nom du diplôme">
        <label for="institution">Institution :</label>
        <input type="text" name="institution" placeholder="Nom de l'institution">
        <label for="year">Année :</label>
        <input type="number" name="year" placeholder="Année d'obtention">
    `;

    educationList.appendChild(educationDiv);
    sortEntries('#education-list', '.education-entry', 'year');
}

function addProject() {
    const projectsList = document.getElementById('projects-list');
    const projectDiv = document.createElement('div');
    projectDiv.classList.add('project-entry');

    projectDiv.innerHTML = `
        <label for="project-name">Nom du projet :</label>
        <input type="text" name="project-name" placeholder="Nom du projet">
        <label for="project-description">Description :</label>
        <input type="text" name="project-description" placeholder="Description du projet">
        <label for="project-year">Année :</label>
        <input type="number" name="project-year" placeholder="Année du projet">
    `;

    projectsList.appendChild(projectDiv);
    sortEntries('#projects-list', '.project-entry', 'project-year');
}

function sortEntries(containerSelector, entrySelector, yearFieldName) {
    const container = document.querySelector(containerSelector);
    const entries = Array.from(container.querySelectorAll(entrySelector));

    entries.sort((a, b) => {
        const yearA = a.querySelector(`input[name="${yearFieldName}"]`).value;
        const yearB = b.querySelector(`input[name="${yearFieldName}"]`).value;
        return yearB - yearA; 
    });

    entries.forEach(entry => container.appendChild(entry));
}

function generateCV() {
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const educationEntries = document.querySelectorAll('.education-entry');
    const projectEntries = document.querySelectorAll('.project-entry');

    let cvContent = `
        <h2>CV de ${name}</h2>
        <p>Email: ${email}</p>
        <h3>Formations</h3>
        <ul>
    `;

    educationEntries.forEach(entry => {
        const degree = entry.querySelector('input[name="degree"]').value;
        const institution = entry.querySelector('input[name="institution"]').value;
        const year = entry.querySelector('input[name="year"]').value;
        cvContent += `<li>${degree} à ${institution}, ${year}</li>`;
    });

    cvContent += `</ul><h3>Projets</h3><ul>`;

    projectEntries.forEach(entry => {
        const projectName = entry.querySelector('input[name="project-name"]').value;
        const projectDescription = entry.querySelector('input[name="project-description"]').value;
        const projectYear = entry.querySelector('input[name="project-year"]').value;
        cvContent += `<li>${projectName} (${projectYear}): ${projectDescription}</li>`;
    });

    cvContent += `</ul>`;

    document.getElementById('cv-output').innerHTML = cvContent;
}

function importXMLData() {
    const xmlData = `
    <profile>
        <name>John Doe</name>
        <email>john.doe@example.com</email>
        <education>
            <entry>
                <degree>Master en Informatique</degree>
                <institution>ECE Paris</institution>
                <year>2023</year>
            </entry>
            <entry>
                <degree>Licence en Informatique</degree>
                <institution>Université de Technologie</institution>
                <year>2020</year>
            </entry>
        </education>
        <projects>
            <entry>
                <name>Projet Erasmus</name>
                <description>Développement d'une application web</description>
                <year>2022</year>
            </entry>
        </projects>
    </profile>
    `;

    const parser = new DOMParser();
    const xmlDoc = parser.parseFromString(xmlData, 'text/xml');

    document.getElementById('name').value = xmlDoc.querySelector('profile > name').textContent;
    document.getElementById('email').value = xmlDoc.querySelector('profile > email').textContent;

    const educationEntries = xmlDoc.querySelectorAll('profile > education > entry');
    const educationList = document.getElementById('education-list');
    educationList.innerHTML = ''; 

    educationEntries.forEach(entry => {
        const degree = entry.querySelector('degree').textContent;
        const institution = entry.querySelector('institution').textContent;
        const year = entry.querySelector('year').textContent;

        const educationDiv = document.createElement('div');
        educationDiv.classList.add('education-entry');

        educationDiv.innerHTML = `
            <label for="degree">Diplôme :</label>
            <input type="text" name="degree" value="${degree}">
            <label for="institution">Institution :</label>
            <input type="text" name="institution" value="${institution}">
            <label for="year">Année :</label>
            <input type="number" name="year" value="${year}">
        `;

        educationList.appendChild(educationDiv);
    });

    const projectEntries = xmlDoc.querySelectorAll('profile > projects > entry');
    const projectsList = document.getElementById('projects-list');
    projectsList.innerHTML = ''; 

    projectEntries.forEach(entry => {
        const projectName = entry.querySelector('name').textContent;
        const projectDescription = entry.querySelector('description').textContent;
        const year = entry.querySelector('year').textContent;

        const projectDiv = document.createElement('div');
        projectDiv.classList.add('project-entry');

        projectDiv.innerHTML = `
            <label for="project-name">Nom du projet :</label>
            <input type="text" name="project-name" value="${projectName}">
            <label for="project-description">Description :</label>
            <input type="text" name="project-description" value="${projectDescription}">
            <label for="project-year">Année :</label>
            <input type="number" name="project-year" value="${year}">
        `;

        projectsList.appendChild(projectDiv);
    });

    updateProfileName(); 
}

$(document).ready(function(){
    $('.image-container img').hover(
        function() {
            $(this).css('transform', 'scale(1.1)');
        },
        function() {
            $(this).css('transform', 'scale(1)');
        }
    );
});
