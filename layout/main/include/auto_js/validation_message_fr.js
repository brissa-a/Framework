jQuery.extend(jQuery.validator.messages, {
    required: "Merci de remplir ce champ !",
    remote: "Ce champ n'est pas rempli correctement",
    email: "Cette adresse mail est invalide.",
    url: "Please enter a valid URL.",
    date: "Merci d'entrer une date de la forme JJ/MM/AAAA",
    dateISO: "Please enter a valid date (ISO).",
    number: "Please enter a valid number.",
    digits: "Merci d'entrer uniquement des chiffres.",
    creditcard: "Please enter a valid credit card number.",
    equalTo: "Please enter the same value again.",
    accept: "Please enter a value with a valid extension.",
    maxlength: jQuery.validator.format("Please enter no more than {0} characters."),
    minlength: jQuery.validator.format("Merci d'entrer au moins {0} caractères."),
    rangelength: jQuery.validator.format("Please enter a value between {0} and {1} characters long."),
    range: jQuery.validator.format("Please enter a value between {0} and {1}."),
    max: jQuery.validator.format("Please enter a value less than or equal to {0}."),
    min: jQuery.validator.format("Please enter a value greater than or equal to {0}.")
});