export default {
    state(){
        return {
            cartItems: [],
            sum: 0
        }
    },
    mutations: {
        setCart(state,payload){
            state.cartItems = payload;
        },
        
        setSum(state){
            state.cartItems.forEach(prop => {
                state.sum += prop.quantity*prop.product.price
                console.log(state.sum);
            });
        }
    },
    actions: {
        async fetchCart({ commit }){
            let response = await this.$axios.get('/cart');
            commit('setCart',response.data);
        },

        async storeCart(store,{ product_id,quantity }){
            await this.$axios.post('/cart/save',{
                product_id: product_id,
                quantity: quantity
            });
        }
    },
    getters: {
        sum(state){
            state.cartItems.forEach(prop => 
                this.sum += prop.quantity*prop.product.price
            );
        }
    }
}