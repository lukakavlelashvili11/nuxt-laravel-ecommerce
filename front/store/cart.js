export default {
    state(){
        return {
            cartItems: [],
            action: false
        }
    },
    mutations: {
        setCart(state,payload){
            state.cartItems = payload;
        },
        
        setAction(state){
            state.action = true;
        },

        unsetAction(state){
            state.action = false;
        }
    },
    actions: {
        // async fetchCart({ commit }){
        //     let response = await this.$axios.get('/cart');
        //     commit('setCart',response.data);
        // },

        async storeCart(store,{ product_id,quantity }){
            await this.$axios.post('/cart/save',{
                product_id: product_id,
                quantity: quantity
            });
        },

        async remove({ commit },{ product_id }){
            await this.$axios.delete('/cart/delete',{
                data: {
                    product_id: product_id
                }
            });
            commit('setAction');
        },
        async updateQuantity({ commit },data){
            await this.$axios.post('/cart/update',{
                ...data
            });
            commit('setAction');
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