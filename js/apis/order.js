function addToCart (e) {
    console.log(e)
}


function postOrder() {
    const btns = document.getElementsByClassName('add-to-cart');
    for(let i = 0; i < btns.length; i++){
        btns[i].addEventListener('click', function (e){
            const product = e.target.value.split('->').reduce((result, str) => {
                const [key, value] = str.split('=');
                result[key] = value;
                return result;
            }, {})
            product.quantity = '1';


            let cart = localStorage.getItem('cart');
            if(!cart) cart = '{}';
            cart = JSON.parse(cart);

            if(!cart[product._id]) {
                alert('Đã thêm vào giỏ hàng');
                cart[product._id] = product;

                localStorage.setItem('cart', JSON.stringify(cart));
            }
            else{
                alert('Sản phẩm đã được thêm trước đó')
            }
        })
    }
}



postOrder()