export const activeUser = () => {
    const btnSubmit = document.getElementById('submit-active-user');

    btnSubmit.addEventListener('click', async function () {
        const tableElement = document.getElementById('table_id');
        const inputs = tableElement.querySelectorAll('.active-seller .active-seller-input');

        const users = [];

        for (let i = 0; i < inputs.length; i++) {
            users.push(inputs[i].value);
        }

        console.log(document.cookie)

        // try {
        //     for (let i = 0; i < users.length; i++) {
        //         const response = await fetch('http://localhost:9000/api/users/active', {
        //             method: 'post',
        //             headers: {
        //                 'Accept': 'application/json',
        //                 'Content-Type': 'application/json',
        //                 credentials: "same-origin"
        //             },
        //             body: JSON.stringify({user_id: users[i]})
        //         })
        //
        //         const content = await response.json();
        //
        //         // console.log(content);
        //     }
        // } catch (e) {
        //     alert(e.message);
        // }
    })
}

