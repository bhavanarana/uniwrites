<script>
  const form = document.getElementById('signup-form');
  let name = document.getElementById('name');
  let email = document.getElementById('email');
  let password = document.getElementById('password');
  let button = document.getElementById("signup-button");
  form.addEventListener('keyup', (e) => {
    e.preventDefault();
    checkValidation();
  });

  function checkValidation() {
    var isInvalid = true;
    let nameValue = name.value.trim();
    let emailValue = email.value.trim();
    let passwordValue = password.value.trim();
    let emailValidate = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;
    if (nameValue == "" || nameValue == null) {
      document.getElementById('name-error').style.display = 'block';
      document.getElementById('name-error').innerText = "Name Cannot be blank";
      isInvalid = false;
    } else {
      document.getElementById('name-error').style.display = 'none';
    }
    if (emailValue == "" || emailValue == null) {
      document.getElementById('email-error').style.display = 'block';
      document.getElementById('email-error').innerText = "Email Cannot be blank";
      isInvalid = false;
    } else if (!emailValidate.test(emailValue)) {
      document.getElementById('email-error').style.display = 'block';
      document.getElementById('email-error').innerText = "Please Enter a Valid email";
      isInvalid = false;
    } else {
      document.getElementById('email-error').style.display = 'none';
    }
    if (passwordValue == "" || passwordValue == null) {
      document.getElementById('password-error').style.display = 'block';
      document.getElementById('password-error').innerText = "Password Cannot be blank";
      isInvalid = false;
      // console.log(passInput);

    } else {
      document.getElementById('password-error').style.display = 'none';
      // console.log(passInput);
    }
    if (isInvalid === true) {
      button.disabled = false;
    } else {
      button.disabled = true;
    }
  }
</script>
<!-- <script>
  let successVal = false;
  const form = document.getElementById('signup-form');
  let name = document.getElementById('name');
  let email = document.getElementById('email');
  let password = document.getElementById('password');
  let button = document.getElementById("signup-button");
  form.addEventListener('keyup', (e) => {
    e.preventDefault();
    checkValidation();
  });

  function checkValidation() {
    let nameValue = name.value.trim();
    let emailValue = email.value.trim();
    let passwordValue = password.value.trim();
    let emailValidate = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;
    if (nameValue == "" || nameValue == null) {
      error(name, 'Username Cannot be blank');
    }
    if (emailValue == "" || emailValue == null) {
      error(email, 'Email Cannot be blank');
    } else(!emailValidate.test(emailValue)) {
      error(email, 'Please Enter a Valid email');
    }
    if (passwordValue == "" || passwordValue == null) {
      error(password, 'password Cannot be blank');
    }
  }

  function error(input, message) {
    inputForm = input.parentElement; //input-form access
    errorMsg = inputForm.querySelector('small');
    errorMsg.innerText = message;
    inputForm.className = 'input-form error';
  }
</script> -->
