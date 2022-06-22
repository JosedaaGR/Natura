/*  ==========================================================================
    Table of Content for Login Page:

    === Function ===
    - runValidation

    --------------------------
    === Function Calls ===

    ========================================================================== */


/*  ==========================================================================
    Functions
    ========================================================================== */

/*
    runValidation
    ========================================================================== */

    function runValidation(formId){

        var form = $(formId);
        form.validate({
            errorPlacement: function errorPlacement(error, element) { element.after(error); },
            rules: {
                loginText: {
                    required: true
                },
                loginPassword: {
                    required: true,
                    minlength: 4
                }
            },
            messages: {
                loginText: {
                    required: "Inserte un usuario correcto"
                },
                loginPassword: {
                    required: "Inserte un password correcto",
                    minlength: jQuery.validator.format("Como minimo {0} caracteres")
                }
            }
        });
    }


/*  ==========================================================================
    Function Calls
   	========================================================================== */

$(function(){

    // Variables
    var loginForm  = '#loginForm';

    // === Checkers ===

    // === Setters ===

    // === Executions ===

    runValidation(loginForm);

});