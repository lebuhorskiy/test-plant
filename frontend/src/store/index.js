import Vue from 'vue'
import Vuex from 'vuex'
import * as api from '../apis/api';

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        plants: {}
    },
    getters: {
        plants: state => state.plants,
    },
    mutations: {
        SET_PLANTS(state, data) {
            state.plants = data;
        },
        DELETE_PLANT(state, id) {
            const index = state.plants.map(item => item.id).indexOf(id);
            state.plants.splice(index, 1);
        }
    },
    actions: {
        getPlants({commit}) {
            api.getPlants().then(response => {
                commit('SET_PLANTS', response.data);
            });
        }
    },
    modules: {}
})
