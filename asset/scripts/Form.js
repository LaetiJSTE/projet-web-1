export class Form {

    constructor(el) {
        this.el = el;
        this.elInputs = this.el.querySelectorAll('input');
        this.elSelects = this.el.querySelectorAll('select');
        this.elBtn = this.el.querySelector('button');

        this.init();
    }


    init() {
        this.elBtn.addEventListener('click', function () {
            //e.preventDefault();
            
            this.inputs();
            this.selects();

        }.bind(this))
    }


    /**
    * Vérification valeur des inputs dans un formulaire 
    */
    inputs() {


        for (let i = 0, l = this.elInputs.length; i < l; i++) {
            let input = this.elInputs[i].value,
                errMsg = "Veuillez entrer les champs requis";

            if (input == "") {
                this.elInputs[i].classList.add('error');
                document.getElementById('erreur').innerText = errMsg;

            } if (!input == "") {
                this.elInputs[i].classList.remove('error');
                document.getElementById('erreur').innerText = "";           
            }
        }
    }


    /**
    * Vérification valeur des selects dans un formulaire 
    */
    selects() {

        for (let i = 0, l = this.elSelects.length; i < l; i++) {

            let value = this.elSelects[i].options[this.elSelects[i].selectedIndex].value;

            if (value == '') this.elSelects[i].classList.add('error');

            else if (!value == '') this.elSelects[i].classList.remove('error');
        }
    }

}