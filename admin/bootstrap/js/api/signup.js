export const SignUp = () => {
  const btnSubmit = document.getElementById("submit-buyer-register");
  btnSubmit.addEventListener("click", function (e) {
    e.preventDefault();
    //console.log(e.target);
    const obj = {
      name: "aada",
      email: "buyer14@gmail.com",
      password: "udpt123",
      role: "buyer",
      mobile_number: "0967654332",
      address: "adsdd",
    };
    //console.log(JSON.parse(JSON.stringify(obj)));
    const signupAPI = async () => {
      try {
        const res = await fetch("http://localhost:9000/api/users", {
          headers: {
            Accept: "application/json",
            "Content-Type": "application/json",
          },
          method: "POST",
          body: JSON.stringify(obj),
        });
        const json = await res.json();
        if (json.code < 200 || json.code >= 300)
          throw new Error(json.data.info);
        console.log(json.data);
        localStorage.setItem("token", json.data.token);
      } catch (error) {
        alert(error.message);
      }
    };
    signupAPI();
  });
};

const testToken = async () => {
  try {
    const res = await fetch("http://localhost:9000/api/users/profile", {
      headers: {
        authorization: "Bearer " + localStorage.getItem("token") || "",
        Accept: "application/json",
        "Content-Type": "application/json",
      },
      method: "GET",
    });
    const json = await res.json();
    if (json.code < 200 || json.code >= 300) throw new Error(json.data.info);
    console.log(json.data);
  } catch (error) {
    alert(error.message);
  }
};
testToken();
