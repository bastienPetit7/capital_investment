const buttonValid = document.getElementById('buttonValid');
const buttonSpinner = document.getElementById('buttonSpinner');

if(buttonValid)
{
    buttonValid.addEventListener('click', () => {
        buttonValid.style.display = 'none';
        buttonSpinner.style.display = 'initial';
    });
}
