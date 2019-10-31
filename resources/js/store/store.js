import Vue from 'vue';
import Vuex from 'vuex';
Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        hide_vehicle_form: false,
        vehicles: [],
        vehiclesCount: 0,
        button_title_add_new_vehicle: 'Dodaj novo vozilo',
        show_vehicle_table: true,
        errors: {},
    },
    mutations: {

        showVehicleForm(state) {
            state.hide_vehicle_form = !state.hide_vehicle_form;
            state.button_title_add_new_vehicle = state.hide_vehicle_form ? 'Sakrij formu' : 'Dodaj novo vozilo';
            state.show_vehicle_table = state.hide_vehicle_form ? false : true;
        },

        setVehicles(state, vehicles) {
            state.vehicles = vehicles;
        },
        setVehiclesCount(state, count) {
            state.vehiclesCount = count;
        },

        setErrors(state, errors){
            state.errors = errors;
        },
    },

    actions: {

        fetchVehicles({ commit }) {
            return axios.get('api/vehicles')
                .then(response => {
                    commit('setVehicles', response.data.vehicles);
                    commit('setVehiclesCount', response.data.count);
                });
        },

        deleteVehicle({commit}, index){
            return axios.delete('api/vehicles/' + index)
                        .then( response => {
                            commit('setVehicles', response.data.vehicles);
                            commit('setVehiclesCount', response.data.count);
                        }).catch( error => {
                            commit('setErrors', error.response.data.errors);
                        });


        },

        saveVehicle({commit, state}, vehicle) {
            console.log(vehicle);
            state.vehicles.push(vehicle); // push to array and show immediately
            axios.post('api/vehicles', vehicle).then( response => {
                commit('setVehicles', response.data.vehicles);
                commit('setVehiclesCount', response.data.count);
                commit('showVehicleForm');
            }).catch( error => {
                commit('setErrors', error.response.data.errors);
            });

        }
    },
})
