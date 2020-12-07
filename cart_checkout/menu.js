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

//---------------Function to empty cart on checkout----------------
function emptyCart() {
    for(let i=0;i< carts.length;i++){    
        let cartDishInfo=localStorage.getItem('dishInformation');
        cartDishInfo=JSON.parse(cartDishInfo);
        console.log(cartDishInfo[dish_name]);
        //remove the number of dishes
        localStorage.setItem("cartNumber", 0);
        //remove the total cost
        localStorage.setItem("TotalCost", 0);
        //set # of the dish in local storage to be 0:
        cartDishInfo[dish_name].inCart=0;
        localStorage.setItem('dishInformation', JSON.stringify(cartDishInfo));

        //update the page:
        UpdateMainPageCart();

        document.querySelector(".basketTotal").textContent="$"+0;
    }
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
    
    localStorage.setItem('dishInformation', JSON.stringify(cartDishInfo))
}
UpdateMainPageCart();
//compute total cost
function totalCost(dish){
    
    let cartCost=localStorage.getItem('TotalCost');
    
    
    if(cartCost!=null){
        cartCost=parseFloat(cartCost);
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
         //the cart # cannot be 0!!
           if(cartItem[item.dishSize].inCart!=0){
           dishescontainer.innerHTML+=`
        <div class="dish">
            <button class="close_button" ><ion-icon name="trash"></ion-icon></button>
            <img class="fish_dish_img" src="fish_dish.jpg" alt="fish dish"/>
            <span class="dish_name" >${item.dishSize}</span>
        </div>
        <div class="price">$${item.price}</div>
        <div class="quantity">
            <button class="decrease_button" ><ion-icon name="caret-back"></ion-icon></button>
            <span>${item.inCart}</span>
            <button class="increase_button" ><ion-icon name="caret-forward"></ion-icon></button>
        </div>
        <div class="total">
            $${item.inCart*item.price}
        </div>
    `}
       })
      dishescontainer.innerHTML+=`
        <div class="basketTotalContainer">
            <h4 class="basketTotalTitle">SubTotal</h4>
            <h4 class="basketTotal">$${cartCost}</h4>
        </div>
        ` 
       
   }
}
                                   
displayCart();

var removeButton=document.getElementsByClassName("close_button");
var dishesInCart=document.getElementsByClassName("dish_name");

console.log(removeButton);
for(let i=0;i<removeButton.length;i++){
    removeButton[i].addEventListener("click",function(){
        removeItem(dishesInCart[i].innerHTML);
      
    })
}
var increaseButton=document.getElementsByClassName("increase_button");
for(let i=0;i<increaseButton.length;i++){
    increaseButton[i].addEventListener("click",function(){
        increaseItem(dishesInCart[i].innerHTML);
      
    })
}
var decreaseButton=document.getElementsByClassName("decrease_button");
for(let i=0;i<decreaseButton.length;i++){
    decreaseButton[i].addEventListener("click",function(){
        decreaseItem(dishesInCart[i].innerHTML);
      
    })
}

function removeItem(dish_name){
    var ok=confirm("Are you sure you want to remove the item? ");
    if(ok==true){     
        let cartDishInfo=localStorage.getItem('dishInformation');
        cartDishInfo=JSON.parse(cartDishInfo);
        console.log(cartDishInfo[dish_name]);
        //remove the number of dishes
        let totalQuantityInCart=localStorage.getItem('cartNumber');
        totalQuantityInCart=parseInt(totalQuantityInCart);
        localStorage.setItem("cartNumber",totalQuantityInCart-cartDishInfo[dish_name].inCart);
        //remove the total cost
        let cartCost=localStorage.getItem('TotalCost');
        cartCost=parseFloat(cartCost);
        let newCartTotal=cartCost-cartDishInfo[dish_name].inCart*cartDishInfo[dish_name].price;
        localStorage.setItem("TotalCost",newCartTotal);
        //set # of the dish in local storage to be 0:
        cartDishInfo[dish_name].inCart=0;
        localStorage.setItem('dishInformation', JSON.stringify(cartDishInfo));

        //update the page:
        UpdateMainPageCart();

        document.querySelector(".basketTotal").textContent="$"+newCartTotal;

        //remove the item row:
        displayCart();
        //update close  buttons and dishes in the cart:
        removeButton=document.getElementsByClassName("close_button");
        dishesInCart=document.getElementsByClassName("dish_name");
        console.log(removeButton);
        for(let i=0;i<removeButton.length;i++){
        removeButton[i].addEventListener("click",function(){
            removeItem(dishesInCart[i].innerHTML);

        })
       } increaseButton=document.getElementsByClassName("increase_button");
        for(let i=0;i<increaseButton.length;i++){
        increaseButton[i].addEventListener("click",function(){
            increaseItem(dishesInCart[i].innerHTML);

        })
        }
        decreaseButton=document.getElementsByClassName("decrease_button");
        for(let i=0;i<decreaseButton.length;i++){
        decreaseButton[i].addEventListener("click",function(){
            decreaseItem(dishesInCart[i].innerHTML);

        })
    }
}

}


function increaseItem(dish_name){
    let cartDishInfo=localStorage.getItem('dishInformation');
    cartDishInfo=JSON.parse(cartDishInfo);
    //increase number of dish:
    let totalQuantityInCart=localStorage.getItem('cartNumber');
    totalQuantityInCart=parseInt(totalQuantityInCart);
    localStorage.setItem("cartNumber",totalQuantityInCart+1);
    //increase the total cost
    let cartCost=localStorage.getItem('TotalCost');
    cartCost=parseFloat(cartCost);
    let newCartTotal=cartCost+cartDishInfo[dish_name].price;
    localStorage.setItem("TotalCost",newCartTotal);
    //set # of the dish in local storage to be 0:
    cartDishInfo[dish_name].inCart+=1;
    localStorage.setItem('dishInformation', JSON.stringify(cartDishInfo));
    
    //update the page:
    UpdateMainPageCart();
     document.querySelector(".basketTotal").textContent="$"+newCartTotal;
    //display result:
    displayCart();
    removeButton=document.getElementsByClassName("close_button");
    dishesInCart=document.getElementsByClassName("dish_name");
    console.log(removeButton);
    for(let i=0;i<removeButton.length;i++){
    removeButton[i].addEventListener("click",function(){
        removeItem(dishesInCart[i].innerHTML);
      
    })
   } increaseButton=document.getElementsByClassName("increase_button");
    for(let i=0;i<increaseButton.length;i++){
    increaseButton[i].addEventListener("click",function(){
        increaseItem(dishesInCart[i].innerHTML);
      
    })
}
    decreaseButton=document.getElementsByClassName("decrease_button");
    for(let i=0;i<decreaseButton.length;i++){
    decreaseButton[i].addEventListener("click",function(){
        decreaseItem(dishesInCart[i].innerHTML);
      
    })
}

}
function decreaseItem(dish_name){
    let cartDishInfo=localStorage.getItem('dishInformation');
    cartDishInfo=JSON.parse(cartDishInfo);
    if(cartDishInfo[dish_name].inCart==0){
        removeItem[dish_name];
    }else{
        //increase number of dish:
        let totalQuantityInCart=localStorage.getItem('cartNumber');
        totalQuantityInCart=parseInt(totalQuantityInCart);
        localStorage.setItem("cartNumber",totalQuantityInCart-1);
        //increase the total cost
        let cartCost=localStorage.getItem('TotalCost');
        cartCost=parseFloat(cartCost);
        let newCartTotal=cartCost-cartDishInfo[dish_name].price;
        localStorage.setItem("TotalCost",newCartTotal);
        //set # of the dish in local storage to be 0:
        cartDishInfo[dish_name].inCart-=1;
        localStorage.setItem('dishInformation', JSON.stringify(cartDishInfo));
   
    //update the page:
    UpdateMainPageCart();
     document.querySelector(".basketTotal").textContent="$"+newCartTotal;
    //display result:
    displayCart();
    removeButton=document.getElementsByClassName("close_button");
    dishesInCart=document.getElementsByClassName("dish_name");
    console.log(removeButton);
    for(let i=0;i<removeButton.length;i++){
    removeButton[i].addEventListener("click",function(){
        removeItem(dishesInCart[i].innerHTML);
      
    })
   } increaseButton=document.getElementsByClassName("increase_button");
    for(let i=0;i<increaseButton.length;i++){
    increaseButton[i].addEventListener("click",function(){
        increaseItem(dishesInCart[i].innerHTML);
      
    })
}
    decreaseButton=document.getElementsByClassName("decrease_button");
    for(let i=0;i<decreaseButton.length;i++){
    decreaseButton[i].addEventListener("click",function(){
        decreaseItem(dishesInCart[i].innerHTML);
      
    })
}
 }


}
//------------------------CheckoutPage-----------------------------
displayBill();
function displayBill(){
    let cartItem=localStorage.getItem('dishInformation');
    cartItem=JSON.parse(cartItem);
   let dishescontainer=document.querySelector(".dishes-Bill");
    let cartCost=localStorage.getItem('TotalCost');
   if(cartItem && dishescontainer){
       dishescontainer.innerHTML="";
       Object.values(cartItem).map(item=>{
         //the cart # cannot be 0!!
           if(cartItem[item.dishSize].inCart!=0){
           dishescontainer.innerHTML+=`
        <div class="dish">
        
            
            <span class="dish_name" >${item.dishSize}</span>
        </div>
        <div class="price">$${item.price}</div>
        <div class="quantity">
           
            <span>${item.inCart}</span>
           
        </div>
        <div class="total">
            $${item.inCart*item.price}
        </div>
    `}
       })
      dishescontainer.innerHTML+=`
        <div class="basketTotalContainer">
            <h4 class="basketTotalTitle">SubTotal</h4>
            <h4 class="basketTotal">$${cartCost}</h4>
        </div>
        ` 
       
   }
    
}





