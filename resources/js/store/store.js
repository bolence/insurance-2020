import Vue from 'vue';
import Vuex from 'vuex';
Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        hide_vehicle_form: false,
        vehicles: [],
        vehiclesCount: 0,
        button_title_add_new_vehicle: 'Dodaj novo vozilo',
    },
    mutations: {
        show_vehicle_form(state) {
            state.hide_vehicle_form = !state.hide_vehicle_form;
            state.button_title_add_new_vehicle = state.hide_vehicle_form ? 'Sakrij formu' : 'Dodaj novo vozilo';
        },

        setVehicles(state, vehicles) {
            state.vehicles = vehicles;
        },
        setVehiclesCount(state, count) {
            state.vehiclesCount = count;
        }
    },

    actions: {

        fetchVehicles({ commit }) {
            return axios.get('api/vehicles')
                .then(response => {
                    commit('setVehicles', response.data.vehicles);
                    commit('setVehiclesCount', response.data.count);
                });
        },

        saveVehicle({commit}, vehicle) {
            state.vehicle.push(vehicle); // push to array and show immediatelly
            // axions.post
            console.log(vehicle);
        }
    },
})