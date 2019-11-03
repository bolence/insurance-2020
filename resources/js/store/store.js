import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({

    state: {
        hide_vehicle_form: false,
        vehicles: [],
        vehicle: {},
        vehiclesCount: 0,
        damagesCount: 0,
        button_title_add_new_vehicle: 'Dodaj novo vozilo',
        button_title_add_new_damage: 'Dodaj štetu',
        show_vehicle_table: true,
        errors: {},
        show_edit_vehicle_form: false,
        not_all_vehicle: false,
        type: '',
        damages: [],

    },
    mutations: {

        showVehicleForm(state) {
            state.hide_vehicle_form = !state.hide_vehicle_form;
            state.button_title_add_new_vehicle = state.hide_vehicle_form ? 'Sakrij formu' : 'Dodaj novo vozilo';
            state.show_vehicle_table = state.hide_vehicle_form ? false : true;
            state.show_edit_vehicle_form = false;
        },

        setVehicles(state, vehicles) {
            state.vehicles = vehicles;
        },
        setDamages(state, damages) {
            state.damages = damages;
        },
        setVehiclesCount(state, count) {
            state.vehiclesCount = count;
        },

        setDamagesCount(state, count) {
            state.damagesCount = count;
        },

        setVehicle(state, vehicle) {
            state.vehicle = vehicle;
        },

        setType(state, type) {
            state.type = type;
        },

        setErrors(state, errors) {
            state.errors = errors;
        },

        showEditForm(state) {
            state.show_edit_vehicle_form = true;
            state.show_vehicle_table = false;
        },

        hideEditForm(state) {
            state.show_edit_vehicle_form = false;
            state.show_vehicle_table = true;
        },

        showButtonToGetAllVehicles(state) {
            state.not_all_vehicle = true;
        }
    },

    actions: {

        fetchVehicles({ commit }) {
            return axios.get('api/vehicles')
                .then(response => {
                    commit('setVehicles', response.data.vehicles);
                    commit('setVehiclesCount', response.data.count);
                    // commit('showButtonToGetAllVehicles');
                });
        },


        fetchDamages({ commit }, type) {
            let string = type !== null ? '?type=' + type : '';
            return axios.get('api/damages' + string)
                .then(response => {
                    commit('setDamages', response.data.damages);
                    commit('setDamagesCount', response.data.count);
                    commit('setVehiclesCount', response.data.count_vehicle);
                });
        },

        deleteVehicle({ commit }, index) {
            return axios.delete('api/vehicles/' + index)
                .then(response => {
                    commit('setVehicles', response.data.vehicles);
                    commit('setVehiclesCount', response.data.count);
                }).catch(error => {
                    commit('setErrors', error.response.data.errors);
                });
        },

        showEditVehicleForm({ commit, state }, vehicle) {
            commit('showEditForm');
            state.vehicle = vehicle;
            // console.log(state.vehicle);
        },

        updateVehicle({ commit, state }, vehicle) {

            state.vehicles.push(vehicle); // push to array and show immediately
            axios.put('api/vehicles/' + vehicle.id, vehicle).then(response => {
                commit('setVehicles', response.data.vehicles);
                commit('setVehiclesCount', response.data.count);
                commit('hideEditForm');

            }).catch(error => {
                state.errors = error.response.data.errors;
            });

        },


        showVehicleType({ commit }, vehicle_type) {
            let string = vehicle_type !== null ? '?type=' + vehicle_type : '';
            return axios.get('api/vehicles' + string)
                .then(response => {
                    commit('setVehicles', response.data.vehicles);
                    commit('setVehiclesCount', response.data.count);
                    commit('setType', vehicle_type);
                    commit('showButtonToGetAllVehicles');
                });
        },


        uploadFiles({ commit }, vehicle) {
            // state.vehicle.push(vehicle);
            commit('setVehicle', vehicle);
        },


        removeFile({ commit, state }, vehicle_id) {
            axios.delete('api/files/' + vehicle_id).then(response => {
                commit('setVehicle', response.data.data);
            }).catch(error => {
                commit('setErrors', error.response.data.errors);
            });
        },


        deleteDamage({ commit, state }, index) {
            axios.delete('api/damages/' + index).then(response => {
                commit('setDamages', response.data.damages);
                commit('setDamagesCount', response.data.count);
                commit('setVehiclesCount', response.data.count_vehicle);
            }).catch(error => {
                commit('setErrors', error.response.data.errors);
            });
        },


        saveVehicle({ commit, state }, vehicle) {
            // console.log(vehicle);
            state.vehicles.push(vehicle); // push to array and show immediately
            axios.post('api/vehicles', vehicle).then(response => {
                commit('setVehicles', response.data.vehicles);
                commit('setVehiclesCount', response.data.count);
                commit('showVehicleForm');
            }).catch(error => {
                commit('setErrors', error.response.data.errors);
            });

        }
    },
})