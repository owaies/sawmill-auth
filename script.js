let isLogin = true;

function toggleForm() {
  const formTitle = document.getElementById("form-title");
  const form = document.getElementById("auth-form");
  const toggleText = document.getElementById("toggle-text");
  const extraField = document.getElementById("extra-field");

  if (isLogin) {
    form.action = "signup.php";
    formTitle.textContent = "Sign Up";
    toggleText.innerHTML = `Already have an account? <span onclick="toggleForm()">Login</span>`;
    extraField.innerHTML = `<input type="text" name="name" placeholder="Full Name" required>`;
  } else {
    form.action = "login.php";
    formTitle.textContent = "Login";
    toggleText.innerHTML = `Don't have an account? <span onclick="toggleForm()">Sign up</span>`;
    extraField.innerHTML = ``;
  }

  isLogin = !isLogin;
}
