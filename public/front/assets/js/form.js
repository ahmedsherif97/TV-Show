// ===== Forms Logic

(function () {

    // OTP Inputs
    const inputs = document.querySelectorAll("#otp-input input");

    for (let i = 0; i < inputs.length; i++) {
        const input = inputs[i];

        input.addEventListener("input", function () {
            // handling normal input
            if (input.value.length == 1 && i + 1 < inputs.length) {
                inputs[i + 1].focus();
            }

            // if a value is pasted, put each character to each of the next input
            if (input.value.length > 1) {
                // sanitise input
                if (isNaN(input.value)) {
                    input.value = "";
                    updateInput();
                    return;
                }

                // split characters to array
                const chars = input.value.split("");

                for (let pos = 0; pos < chars.length; pos++) {
                    // if length exceeded the number of inputs, stop
                    if (pos + i >= inputs.length) break;

                    // paste value
                    let targetInput = inputs[pos + i];
                    targetInput.value = chars[pos];
                }

                // focus the input next to the last pasted character
                let focus_index = Math.min(inputs.length - 1, i + chars.length);
                inputs[focus_index].focus();
            }
            updateInput();
        });

        input.addEventListener("keydown", function (e) {
            // backspace button
            if (e.keyCode == 8 && input.value == "" && i != 0) {
                // shift next values towards the left
                for (let pos = i; pos < inputs.length - 1; pos++) {
                    inputs[pos].value = inputs[pos + 1].value;
                }

                // clear previous box and focus on it
                inputs[i - 1].value = "";
                inputs[i - 1].focus();
                updateInput();
                return;
            }

            // delete button
            if (e.keyCode == 46 && i != inputs.length - 1) {
                // shift next values towards the left
                for (let pos = i; pos < inputs.length - 1; pos++) {
                    inputs[pos].value = inputs[pos + 1].value;
                }

                // clear the last box
                inputs[inputs.length - 1].value = "";
                input.select();
                e.preventDefault();
                updateInput();
                return;
            }

            // left button
            if (e.keyCode == 37) {
                if (i > 0) {
                    e.preventDefault();
                    inputs[i - 1].focus();
                    inputs[i - 1].select();
                }
                return;
            }

            // right button
            if (e.keyCode == 39) {
                if (i + 1 < inputs.length) {
                    e.preventDefault();
                    inputs[i + 1].focus();
                    inputs[i + 1].select();
                }
                return;
            }

        });
        
    }

    function updateInput() {
        let inputValue = Array.from(inputs).reduce(function (otp, input) {
            otp += input.value.length ? input.value : " ";
            return otp;
        }, "");
        document.querySelector("input[name=otp]").value = inputValue;
    }
})();

// Toggle password
function togglePasswordType(el) {
    let passwordInput = el.parentElement.querySelector('input'),
        eye = el.querySelector('i')

    if (eye.classList.contains('fa-eye')) {
        eye.classList.replace('fa-eye', 'fa-eye-slash')
        passwordInput.type = "text"
    } else {
        eye.classList.replace('fa-eye-slash', 'fa-eye')
        passwordInput.type = "password"
    }
}

// Confirm password match
function checkPasswordMatch() {
    const password = document.querySelector('input[name=password]');
    const confirm = document.querySelector('input[name=password_confirm]');
    if (confirm.value === password.value) {
        confirm.setCustomValidity('');
    } else {
        confirm.setCustomValidity('كلمة المرور غير متطابقة');
    }
}

// ====== Populate the country select element with options
const countrySelect = document.getElementById('country');
if (countrySelect && countryTranslations) {
  for (let key in countryTranslations) {
      const option = document.createElement('option');
      option.value = key;
      option.textContent = countryTranslations[key];
      countrySelect.appendChild(option);
  }
}

// Countdown timer
let interval;
function countdown(formId) {
    clearInterval(interval);
    let timerElement = document.querySelector(".js-timeout");

    if (timerElement) {
        timerElement.classList.remove('timeout-ended', 'hidden');

        // Parse initial time
        let initialTimeArray = timerElement.innerText.trim().split(":").map(Number);
        let initialHours = 0, initialMinutes = 0, initialSeconds = 0;

        if (initialTimeArray.length === 3) {
            [initialHours, initialMinutes, initialSeconds] = initialTimeArray;
        } else if (initialTimeArray.length === 2) {
            [initialMinutes, initialSeconds] = initialTimeArray;
        } else if (initialTimeArray.length === 1) {
            [initialSeconds] = initialTimeArray;
        }

        let totalInitialSeconds = initialHours * 3600 + initialMinutes * 60 + initialSeconds;
        let remainingSeconds = totalInitialSeconds;

        interval = setInterval(() => {
            if (remainingSeconds <= 0) {
                clearInterval(interval);
                timerElement.classList.add('timeout-ended', 'hidden');

                if (typeof resendBtn != "undefined") {
                    resendBtn.removeAttribute('disabled');
                    resendBtn.classList.add('hover:underline');
                    resendBtn.innerText = 'إعادة الإرسال';
                }

                if (formId) {
                    const form = document.getElementById(formId);
                    if (form) form.submit();
                }
                return;
            }

            remainingSeconds--;

            const currentHours = Math.floor(remainingSeconds / 3600);
            const currentMinutes = Math.floor((remainingSeconds % 3600) / 60);
            const currentSeconds = remainingSeconds % 60;

            const displayHours = currentHours > 0 ? String(currentHours).padStart(2, '0') + ":" : "";
            const displayMinutes = String(currentMinutes).padStart(2, '0');
            const displaySeconds = String(currentSeconds).padStart(2, '0');

            timerElement.innerText = `${displayHours}${displayMinutes}:${displaySeconds}`;

            // Percentage of remaining time (you can use this anywhere as needed)
            const percentageRemaining = Math.round((remainingSeconds / totalInitialSeconds) * 100);
            //console.log("Remaining %:", percentageRemaining);

            // Exam circular progress timer
            let circularProgress = timerElement.closest('.circular-progress')
            if (circularProgress) {
                circularProgress.style = '--value:' + percentageRemaining
                if (percentageRemaining <= 25) {
                    circularProgress.querySelector('.real-progress').classList.remove('text-white')
                    circularProgress.querySelector('.real-progress').classList.add('text-error')

                    timerElement.classList.remove('text-white')
                    timerElement.classList.add('text-error')
                }
            }
        }, 1000);
    }
}

// ====== Date
function getFormattedDate() {
  let today = new Date();
  let dd = String(today.getDate()).padStart(2, "0");
  let mm = String(today.getMonth() + 1).padStart(2, "0"); // January is 0!
  let yyyy = today.getFullYear();

  return yyyy + "-" + mm + "-" + dd;
}
// Sets 'max' attr of input to today's date
document.querySelectorAll(".max-date-today").forEach((item) => {
  if (item) item.setAttribute("max", getFormattedDate());
});

document.querySelectorAll(".date-input").forEach((item) => {
  let dateInput = item.querySelector("input[type=date]"),
    textInput = item.querySelector("input[type=text]");

  if (dateInput) {
    dateInput.addEventListener("change", (e) => {
      textInput.value = e.target.value;
    });

    textInput.addEventListener("click", () => dateInput.showPicker());
    textInput.addEventListener("blur", () => dateInput.blur());
  }
});

// Profile Picture upload
function uploadImage() {
  const fileUploadInput = document.querySelector(".image-uploader");

  /// Validations ///
  if (!fileUploadInput.value) {
    return;
  }

  // using index [0] to take the first file from the array
  const image = fileUploadInput.files[0];

  // check if the file selected is not an image file
  if (!image.type.includes("image")) {
    return alert("الرجاء التأكد من رفع ملف نوعه صورة وليس أي نوع آخر.");
  }

  // check if size (in bytes) exceeds 10 MB
  if (image.size > 50_000_000) {
    return alert("الرجاء رفع صورة مساحتها أقل من 50 ميجا");
  }

  /// Display the image on the screen ///
  const fileReader = new FileReader();
  fileReader.readAsDataURL(image);

  fileReader.onload = (fileReaderEvent) => {
    const profilePicture = document.querySelector(".profile-picture");
    profilePicture.src = fileReaderEvent.target.result;
  };

  // upload image to the server or the cloud
}
  