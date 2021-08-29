export default {
    state(){
        return {
            cartItems: [],
            action: false,
            cartStatus: false
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
        },

        setCartStatus(state,payload){
            state.cartStatus = payload;
        },

        unsetCartStatus(state){
            state.cartStatus = false;
        },

    },
    actions: {
        async storeCart(store,{ product_id,quantity }){
            let status = await this.$axios.post('/cart/save',{
                product_id: product_id,
                quantity: quantity
            });
            store.commit('setCartStatus',status.data);
            store.commit('setAction');
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
        getAction(state){
            return state.action;
        }
    }
}