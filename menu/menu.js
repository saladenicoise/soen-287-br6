var carts =document.getElementsByClassName('add-cart');

var dishes=[{
    dishSize: 'Family Size',
    price: 31,
    inCart: 0,
},
{ 
    dishSize : 'Couple size',
    price: 21,
    inCart: 0,
            
},
{
    dishSize : 'Single Size',
    price: 12.50,
    inCart: 0,
},{
    dishSize: 'Adult Portion',
    price: 9.50,
    inCart: 0,
},
{
    dishSize: 'Kids Size',
    price: 5.50,
    inCart: 0
},{
    dishSize: 'GlutenFree',
    price: 3.50,
    inCart: 0
}
        

 ]

for(let i=0;i< carts.length;i++){
    carts[i].addEventListener('click',function(){
        CartQuantity(dishes[i]);
        totalCost(dishes[i]);
    })
}


function UpdateMainPageCart(){
   var totalQuantityInCart=localStorage.getItem('cartNumber');
    
   if(totalQuantityInCart){
       document.querySelector('.MainPageCart').textContent=totalQuantityInCart;
   } 
    else{
        document.querySelector('.MainPageCart').textContent=0;
}
   
}
function CartQuantity(dish){
    
    var totalQuantityInCart=localStorage.getItem('cartNumber');
    totalQuantityInCart=parseInt(totalQuantityInCart);
    if(totalQuantityInCart){
        localStorage.setItem('cartNumber', totalQuantityInCart+1);
        document.querySelector('.MainPageCart').textContent=totalQuantityInCart+1;

    }else{
        localStorage.setItem('cartNumber', 1);
        document.querySelector('.MainPageCart').textContent=1;
    }
    setDishes(dish);
}

function setDishes(dish){
   let cartDishInfo=localStorage.getItem('dishInformation');
    cartDishInfo=JSON.parse(cartDishInfo);
    if(cartDishInfo!=null){
        if(cartDishInfo[dish.dishSize]==undefined){
            cartDishInfo={...cartDishInfo,
            [dish.dishSize]:dish}
        }
        cartDishInfo[dish.dishSize].inCart+=1;
    }else{
        dish.inCart=1;
        cartDishInfo={[dish.dishSize]:dish};
        
    }
    
    localStorage.setItem('dishInformation', JSON.stringify(cartDishInfo));
}
UpdateMainPageCart();
//compute total cost
function totalCost(dish){
    
    let cartCost=localStorage.getItem('TotalCost');
    
    
    if(cartCost!=null){
        cartCost=parseInt(cartCost);
        localStorage.setItem('TotalCost',cartCost+dish.price);
    }else{
        localStorage.setItem('TotalCost',dish.price);
    }
    
}
//display everything on the cart page:
function displayCart(){
    let cartItem=localStorage.getItem('dishInformation');
    cartItem=JSON.parse(cartItem);
   let dishescontainer=document.querySelector(".dishes");
    let cartCost=localStorage.getItem('TotalCost');
   if(cartItem && dishescontainer){
       dishescontainer.innerHTML="";
       Object.values(cartItem).map(item=>{
           dishescontainer.innerHTML+=`
        <div class="dish">
            <button class="close_button" onclick="removeItem()"><ion-icon name="trash"></ion-icon></button>
            <img class="fish_dish_img" src="fish_dish.jpg" alt="fish dish"/>
            <span class="dish_name">${item.dishSize}</span>
        </div>
        <div class="price">${item.price}</div>
        <div class="quantity">
            <button class="decrease_button" onclick="decrease()"><ion-icon name="caret-back"></ion-icon></button>
            <span>${item.inCart}</span>
            <button class="increase_button" onclick="increase()"><ion-icon name="caret-forward"></ion-icon></button>
        </div>
        <div class="total">
            $${item.inCart*item.price}
        </div>
    `
       })
      dishescontainer.innerHTML+=`
        <div class="basketTotalContainer">
            <h4 class="basketTotalTitle">SubTotal</h4>
            <h4 class="basketTotal">$${cartCost}</h4>
        </div>
        ` 
       
   }
}
displayCart()


function removeItem(dish){
    confirm("Are you sure you want to remove the item? ");
    let cartItem=localStorage.getItem('dishInformation');
    cartItem=JSON.parse(cartItem);
    var dishName=document.getElementsByClassName("dish_name");
    console.log(dishName);
    var closeButton=document.getElementsByClassName("close_button");
    console.log(closeButton);
}