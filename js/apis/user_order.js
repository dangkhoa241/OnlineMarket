function user_order() {
    let cart = localStorage.getItem('cart');
    if (!cart) cart = '{}';
    cart = JSON.parse(cart);
    const values = Object.values(cart);


    const tbody = document.getElementById('tbody_my_cart');
    for (let i = 0; i < values.length; i++) {
        tbody.innerHTML += mergeHTML(values[i]);
    }

    const input_number = tbody.querySelectorAll('.q_my_cart');
    for (let i = 0; i < input_number.length; i++) {
        input_number[i].addEventListener('change', function (e) {
            console.log(this.dataset.product_id);

            cart[this.dataset.product_id].quantity = e.target.value;
            localStorage.setItem('cart', JSON.stringify(cart));

            tbody.innerHTML = '';
            for (let i = 0; i < values.length; i++) {
                tbody.innerHTML += mergeHTML(values[i]);
            }
        });
    }
}

const createOrder = () => {
    let cart = localStorage.getItem('cart');
    if (!cart) cart = '{}';
    cart = JSON.parse(cart);
    cart = Object.values(cart).map(c => ({product_id: c._id, quantity: c.quantity}));

    document.getElementById('id_dat_hang').addEventListener('click', function (e) {
        // call api
        const getUser = async () => {
            const res = await fetch('http://localhost:9000/api/users');
            const {data: users} = await res.json();
            const buyer = users.filter(u => u.role === 'buyer');
            console.log(buyer);

            for (let i = 0; i < buyer.length; i++) {
                const res = await fetch('http://localhost:9000/api/orders', {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        "payment_method": "banking",
                        "products": cart,
                        "user_id" : buyer[i]._id
                    })
                });
                const {data} = await res.json();

                console.log(data);
            }
        }
        getUser();
        // remove from local store
    })
};

function mergeHTML(data) {
    return `
        <tr>
            <td class="cart-image">
                <a class="entry-thumbnail" href="detail.html">
                    <img src="${data.image}"
                         alt="" width="114" height="146">
                </a>
            </td>
            <td class="cart-product-name-info">
                <h4 class='cart-product-description'>${data.product_name}</h4>
            </td>
            <td class="cart-product-quantity">
                <div class="quant-input">
                    <input class="q_my_cart" type="text" value="${+data.quantity}" name="quantity" data-product_id="${data._id}">
                </div>
            </td>
            <td class="cart-product-sub-total"><span
                        class="cart-sub-total-price">${+data.price} VND</span>
            </td>
            <td class="cart-product-grand-total"><span
                        class="cart-grand-total-price">${+data.price * +data.quantity} VND</span>
            </td>
        </tr>
    `
}

user_order();
createOrder();