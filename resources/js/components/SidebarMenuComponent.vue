<template>
    <div>


        <nav class="pcoded-navbar">
        <div class="pcoded-inner-navbar main-menu">
            <div class="pcoded-navigatio-lavel">Navigation</div>
            <ul class="pcoded-item pcoded-left-item">
                <li class="pcoded">
                    <a href="/home">
                        <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                        <span class="pcoded-mtext">Dashboard</span>
                    </a>
                </li>
                <li class="pcoded">
                    <a href="/vehicles">
                        <span class="pcoded-micon"><i class="fa fa-car"></i></span>
                        <span class="pcoded-mtext">Vozila</span>
                        <span class="pcoded-badge label label-warning ml-5" title="Broj vozila">{{ vehicle_count }}</span>
                    </a>
                </li>
                <li class="">
                    <a href="/insurance">
                        <span class="pcoded-micon"><i class="feather icon-menu"></i></span>
                        <span class="pcoded-mtext">Osiguranje</span>
                    </a>
                </li>
                <li class="pcoded">
                    <a href="/damages">
                        <span class="pcoded-micon"><i class="feather icon-layers"></i></span>
                        <span class="pcoded-mtext">Štete</span>
                        <span class="pcoded-badge label label-danger">{{ damage_count }}</span>
                    </a>
                </li>

                <li class="pcoded">
                    <a href="/kasko">
                        <span class="pcoded-micon"><i class="feather icon-box"></i></span>
                        <span class="pcoded-mtext">Kasko</span>
                    </a>
                </li>

                <li class="pcoded">
                    <a href="/reports">
                        <span class="pcoded-micon"><i class="fa fa-file-pdf-o"></i></span>
                        <span class="pcoded-mtext">Izveštaji</span>
                    </a>
                </li>
            </ul>






        </div>
    </nav>

    </div>
</template>


<script>

import store from '../store/store';
import {mapState} from 'vuex';

export default {
    data() {
        return {

        }
    },


    computed: {

         ...mapState({
            vehicle_count: state => state.vehiclesCount,
            damage_count: state => state.damagesCount,
        })

    },

    mounted() {

    },


    methods: {

    },
}
</script>



<style scoped>

</style>
