btnGenerator = document.querySelector('#generate-string');
divContent = document.querySelector('#string-generated');

btnGenerator.addEventListener('click', () => {
    divContent.innerText = generateRandomString(8);
});