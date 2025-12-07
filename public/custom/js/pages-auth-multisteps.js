/**
 *  Page auth register multi-steps
 */

'use strict';

// Select2 (jquery)
$(function () {
    var select2 = $('.select2');

    // select2
    if (select2.length) {
        select2.each(function () {
            var $this = $(this);
            $this.wrap('<div class="position-relative"></div>');
            $this.select2({
                placeholder: 'اختر',
                dropdownParent: $this.parent()
            });
        });
    }
});

// Multi Steps Validation
// --------------------------------------------------------------------
document.addEventListener('DOMContentLoaded', function (e) {
    (function () {
        const stepsValidation = document.querySelector('#multiStepsValidation');
        if (typeof stepsValidation !== undefined && stepsValidation !== null) {
            // Multi Steps form
            const stepsValidationForm = stepsValidation.querySelector('#multiStepsForm');
            // Form steps
            const stepsValidationFormStep1 = stepsValidationForm.querySelector('#accountDetailsValidation');
            const stepsValidationFormStep2 = stepsValidationForm.querySelector('#personalInfoValidation');
            const stepsValidationFormStep3 = stepsValidationForm.querySelector('#billingLinksValidation');
            // Multi steps next prev button
            const stepsValidationNext = [].slice.call(stepsValidationForm.querySelectorAll('.btn-next'));
            const stepsValidationPrev = [].slice.call(stepsValidationForm.querySelectorAll('.btn-prev'));

            const multiStepsExDate = document.querySelector('.multi-steps-exp-date'),
                multiStepsCvv = document.querySelector('.multi-steps-cvv'),
                multiStepsMobile = document.querySelector('.multi-steps-mobile'),
                multiStepsPincode = document.querySelector('.multi-steps-pincode'),
                multiStepsCard = document.querySelector('.multi-steps-card');

            // Expiry Date Mask
            if (multiStepsExDate) {
                new Cleave(multiStepsExDate, {
                    date: true,
                    delimiter: '/',
                    datePattern: ['m', 'y']
                });
            }

            // CVV
            if (multiStepsCvv) {
                new Cleave(multiStepsCvv, {
                    numeral: true,
                    numeralPositiveOnly: true
                });
            }

            // Mobile
            if (multiStepsMobile) {
                new Cleave(multiStepsMobile, {
                    phone: true,
                    phoneRegionCode: 'US'
                });
            }

            // Pincode
            if (multiStepsPincode) {
                new Cleave(multiStepsPincode, {
                    delimiter: '',
                    numeral: true
                });
            }

            // Credit Card
            if (multiStepsCard) {
                new Cleave(multiStepsCard, {
                    creditCard: true,
                    onCreditCardTypeChanged: function (type) {
                        if (type != '' && type != 'unknown') {
                            document.querySelector('.card-type').innerHTML =
                                '<img src="' + assetsPath + 'img/icons/payments/' + type + '-cc.png" height="28"/>';
                        } else {
                            document.querySelector('.card-type').innerHTML = '';
                        }
                    }
                });
            }

            let validationStepper = new Stepper(stepsValidation, {
                linear: true
            });

            // Account details
            const multiSteps1 = FormValidation.formValidation(stepsValidationFormStep1, {
                fields: {
                    multiStepsUsername: {
                        validators: {
                            notEmpty: {
                                message: 'Please enter username'
                            },
                            stringLength: {
                                min: 6,
                                max: 30,
                                message: 'The name must be more than 6 and less than 30 characters long'
                            },
                            regexp: {
                                regexp: /^[a-zA-Z0-9 ]+$/,
                                message: 'The name can only consist of alphabetical, number and space'
                            }
                        }
                    },
                    multiStepsEmail: {
                        validators: {
                            notEmpty: {
                                message: 'Please enter email address'
                            },
                            emailAddress: {
                                message: 'The value is not a valid email address'
                            }
                        }
                    },
                    multiStepsPass: {
                        validators: {
                            notEmpty: {
                                message: 'Please enter password'
                            }
                        }
                    },
                    multiStepsConfirmPass: {
                        validators: {
                            notEmpty: {
                                message: 'Confirm Password is required'
                            },
                            identical: {
                                compare: function () {
                                    return stepsValidationFormStep1.querySelector('[name="multiStepsPass"]').value;
                                },
                                message: 'The password and its confirm are not the same'
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap5: new FormValidation.plugins.Bootstrap5({
                        // Use this for enabling/changing valid/invalid class
                        // eleInvalidClass: '',
                        eleValidClass: '',
                        rowSelector: '.col-sm-6'
                    }),
                    autoFocus: new FormValidation.plugins.AutoFocus(),
                    submitButton: new FormValidation.plugins.SubmitButton()
                },
                init: instance => {
                    instance.on('plugins.message.placed', function (e) {
                        if (e.element.parentElement.classList.contains('input-group')) {
                            e.element.parentElement.insertAdjacentElement('afterend', e.messageElement);
                        }
                    });
                }
            }).on('core.form.valid', function () {
                // Jump to the next step when all fields in the current step are valid
                validationStepper.next();
            });

            // Personal info
            const multiSteps2 = FormValidation.formValidation(stepsValidationFormStep2, {
                fields: {
                    multiStepsFirstName: {
                        validators: {
                            notEmpty: {
                                message: 'Please enter first name'
                            }
                        }
                    },
                    multiStepsAddress: {
                        validators: {
                            notEmpty: {
                                message: 'Please enter your address'
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap5: new FormValidation.plugins.Bootstrap5({
                        // Use this for enabling/changing valid/invalid class
                        // eleInvalidClass: '',
                        eleValidClass: '',
                        rowSelector: function (field, ele) {
                            // field is the field name
                            // ele is the field element
                            switch (field) {
                                case 'multiStepsFirstName':
                                    return '.col-sm-6';
                                case 'multiStepsAddress':
                                    return '.col-md-12';
                                default:
                                    return '.row';
                            }
                        }
                    }),
                    autoFocus: new FormValidation.plugins.AutoFocus(),
                    submitButton: new FormValidation.plugins.SubmitButton()
                }
            }).on('core.form.valid', function () {
                // Jump to the next step when all fields in the current step are valid
                validationStepper.next();
            });

            // Social links
            const multiSteps3 = FormValidation.formValidation(stepsValidationFormStep3, {
                fields: {
                    multiStepsCard: {
                        validators: {
                            notEmpty: {
                                message: 'Please enter card number'
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap5: new FormValidation.plugins.Bootstrap5({
                        // Use this for enabling/changing valid/invalid class
                        // eleInvalidClass: '',
                        eleValidClass: '',
                        rowSelector: function (field, ele) {
                            // field is the field name
                            // ele is the field element
                            switch (field) {
                                case 'multiStepsCard':
                                    return '.col-md-12';

                                default:
                                    return '.col-dm-6';
                            }
                        }
                    }),
                    autoFocus: new FormValidation.plugins.AutoFocus(),
                    submitButton: new FormValidation.plugins.SubmitButton()
                },
                init: instance => {
                    instance.on('plugins.message.placed', function (e) {
                        if (e.element.parentElement.classList.contains('input-group')) {
                            e.element.parentElement.insertAdjacentElement('afterend', e.messageElement);
                        }
                    });
                }
            }).on('core.form.valid', function () {

                // Serialize form data
                const formData = new FormData(stepsValidationForm);
                // Prepare an array to hold form data entries
                const formDataEntries = [];
                // Iterate over the FormData entries
                for (let [name, value] of formData.entries()) {
                    // Add each entry to the formDataEntries array
                    formDataEntries.push(`${name}: ${value}`);
                }
                // Join the array elements into a string
                const formDataString = formDataEntries.join('\n');

                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                formData.append('_token', csrfToken);
                // Alert the serialized form data

                $(stepsValidationForm).find('[type=submit]').attr('disabled', true);
                $(stepsValidationForm).find('[type=submit] .spinner').removeClass('d-none');

                // Send form data via AJAX
                fetch('/partner', {
                    method: 'POST',
                    body: formData
                })
                    .then(response => response.json())
                    .then(data => {
                        // Handle response from server
                        console.log(data);
                        // Example: display success message to user
                        if (data.success) {
                            toastr.options = {
                                "timeOut": 6000,
                                "extendedTimeOut": 6000,
                                "closeButton": true,
                                "positionClass": "toast-top-full-width",
                            };
                            toastr.success(data.message);
                            setTimeout(function () {
                                window.location.href = data.url;
                            }, 6000);
                        } else {
                            // Display validation errors
                            Object.values(data.errors).forEach(error => {
                                toastr.error(error[0]);
                            });
                            $(stepsValidationForm).find('[type=submit]').attr('disabled', false);
                            $(stepsValidationForm).find('[type=submit] .spinner').addClass('d-none');
                        }
                        ;
                    });
            });

            stepsValidationNext.forEach(item => {
                item.addEventListener('click', event => {
                    // When click the Next button, we will validate the current step
                    switch (validationStepper._currentIndex) {
                        case 0:
                            multiSteps1.validate();
                            break;

                        case 1:
                            multiSteps2.validate();
                            break;

                        case 2:
                            multiSteps3.validate();
                            break;

                        default:
                            break;
                    }
                });
            });

            stepsValidationPrev.forEach(item => {
                item.addEventListener('click', event => {
                    switch (validationStepper._currentIndex) {
                        case 2:
                            validationStepper.previous();
                            break;

                        case 1:
                            validationStepper.previous();
                            break;

                        case 0:

                        default:
                            break;
                    }
                });
            });
        }
    })();
});