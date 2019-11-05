<template>

    <div v-show="new_insurance_form">
  <b-card no-body>
    <b-tabs card>
      <b-tab title="Novo osiguranje">
        <b-card-text>
<div class="card">
<div class="card-header">
<h2>Dodaj novo osiguranje</h2>
</div>

<div class="card-block">

<form class="j-pro" id="j-pro">
<!-- end /.header-->
<div class="j-content">

     <div class="j-row">


         <!-- Os drustvo -->
        <div class="j-span3 j-unit">
            <label class="j-label">Os.društvo</label>
            <label class="j-input j-select" for="os_drustvo">
            <select name="os_drustvo" v-model="os_drustvo">
            <option value="" selected>Izaberi osiguranje</option>
            <option value="DUNAV">DUNAV</option>
            <option value="TRIGLAV">TRIGLAV</option>
            <option value="GENERALI">GENERALI</option>
            <option value="DDOR">DDOR</option>
            </select>
            <i></i>
            </label>
            <span class="text-danger" v-if="errors.os_drustvo">{{ errors.os_drustvo[0] }}</span>
        </div>


         <!-- Os drustvo -->
        <div class="j-span3 j-unit">
             <label class="j-label">Broj polise</label>
            <div class="j-input">
            <label class="j-icon-right" for="broj_polise">
            <i class="icofont icofont-car-alt-1"></i>
            </label>
            <input type="text" placeholder="Broj polise" id="broj_polise" name="broj_polise" v-model="broj_polise">
            <span class="text-danger" v-if="errors.broj_polise">{{ errors.broj_polise[0] }}</span>
            </div>
        </div>


         <!-- Visina premije -->
        <div class="j-span3 j-unit">
            <label class="j-label">Visina premije</label>
            <div class="j-input">
            <label class="j-icon-right" for="visina_premije">
            <i class="icofont icofont-car-alt-1"></i>
            </label>
            <input type="text" placeholder="Visina premije" id="visina_premije" name="visina_premije" v-model="visina_premije">
            <span class="text-danger" v-if="errors.visina_premije">{{ errors.visina_premije[0] }}</span>
            </div>
        </div>


         <!-- Isticanje osiguranja -->
        <div class="j-span3 j-unit">
            <label class="j-label">Datum registracije</label>
            <div class="j-input">
            <label class="j-icon-right" for="datum_isticanja_osiguranja">
            <i class="icofont icofont-ui-calendar"></i>
            </label>

            <datepicker v-model="datum_isticanja_osiguranja" name="datum_isticanja_osiguranja" format="dd MMM" :language="sr" input-class="form-control" calendar-button-icon="fa fa-calendar"></datepicker>
            <span class="text-info" v-show="!errors.datum_isticanja_osiguranja">Unosi se datum obnove registracije</span>
            <span class="text-danger" v-if="errors.datum_isticanja_osiguranja">{{ errors.datum_isticanja_osiguranja[0] }}</span>
            </div>
        </div>

    </div>
<!-- end name -->

<!-- start response from server -->
<div class="j-response" v-if="errors.message">{{ errors.message }}</div>
<!-- end response from server -->
</div>
<!-- end /.content -->
<div class="j-footer">
<button class="btn btn-primary" @click.prevent="newInsurance(vehicle_id)"><i class="icofont icofont-car-alt-1"></i> Snimi osiguranje</button>
<button class="btn btn-default m-r-20" @click.prevent="$store.commit('showNewInsuranceForm')">Zatvori</button>
</div>
<!-- end /.footer -->
</form>



                        </div>

                    </div>

        </b-card-text>
      </b-tab>

        <b-tab title="Novo kasko">
        <b-card-text>

            <div class="card">
<div class="card-header">
<h2>Dodaj novo kasko osiguranje</h2>
</div>

<div class="card-block">

            <form class="j-pro" id="j-pro">
<!-- end /.header-->
<div class="j-content">

     <div class="j-row">


         <div class="j-span3 j-unit">
            <label class="j-label">Os.društvo kasko</label>
            <label class="j-input j-select" for="os_drustvo_kasko">
            <select name="os_drustvo" v-model="os_drustvo_kasko">
            <option value="" selected>Izaberi kasko</option>
            <option value="DUNAV">DUNAV</option>
            <option value="TRIGLAV">TRIGLAV</option>
            <option value="GENERALI">GENERALI</option>
            <option value="DDOR">DDOR</option>
            </select>
            <i></i>
            </label>
        </div>



        <div class="j-span3 j-unit">
              <label class="j-label">Broj polise kasko</label>
            <div class="j-input">
            <label class="j-icon-right" for="broj_polise_kasko">
            <i class="icofont icofont-car-alt-1"></i>
            </label>

            <input type="text" placeholder="Broj polise kasko" id="broj_polise_kasko" name="broj_polise_kasko" v-model="broj_polise_kasko">
            </div>
        </div>



        <div class="j-span3 j-unit">
               <label class="j-label">Visina premije kasko</label>
            <div class="j-input">
            <label class="j-icon-right" for="visina_premija_kasko">
            <i class="icofont icofont-car-alt-1"></i>
            </label>

            <input type="text" placeholder="Visina premije kasko" id="visina_premija_kasko" name="visina_premija_kasko" v-model="visina_premije_kasko">

            </div>
        </div>



        <div class="j-span3 j-unit">
            <label class="j-label">Datum isticanja kaska</label>
            <div class="j-input">
            <label class="j-icon-right" for="datum_isticanja_kasko">
            <i class="icofont icofont-car-alt-1"></i>
            </label>
            <datepicker v-model="datum_isticanja_kasko"  name="datum_isticanja_kasko" format="dd MMM" :language="sr" input-class="form-control" calendar-button-icon="fa fa-calendar"></datepicker>
            <span class="text-info">Unosi se datum kasko vozila</span>
            </div>
        </div>

    </div>
<!-- end name -->

<!-- start response from server -->
<div class="j-response" v-if="errors.message">{{ errors.message }}</div>
<!-- end response from server -->
</div>
<!-- end /.content -->
<div class="j-footer">
<button class="btn btn-primary" @click.prevent="newKasko(vehicle_id)"><i class="icofont icofont-car-alt-1"></i> Snimi kasko</button>
<button class="btn btn-default m-r-20" @click.prevent="$store.commit('showNewInsuranceForm')">Zatvori</button>
</div>
<!-- end /.footer -->
</form>
</div>
            </div>

        </b-card-text>
        </b-tab>
    </b-tabs>
  </b-card>



    </div>
</template>




<script>
import store from '../../store/store';
import {mapState} from 'vuex';
import Datepicker from 'vuejs-datepicker';
import {sr} from 'vuejs-datepicker/dist/locale';

export default {
    components: {
        Datepicker,
    },
    data() {
        return {
            sr: sr,
            os_drustvo: '',
            visina_premije: '',
            broj_polise: '',
            datum_isticanja_osiguranja: '',
            os_drustvo_kasko: '',
            visina_premije_kasko: '',
            broj_polise_kasko: '',
            datum_isticanja_kasko: '',

        }
    },

      computed: {
         ...mapState({
            new_insurance_form: state => state.new_insurance_form,
            vehicle_id: state => state.vehicle_id,
            show_notifications: state => state.show_notifications,
            errors: state => state.errors,
        })
    },

    methods: {

           newInsurance(vehicle_id){

            let data = {
                vehicle_id : vehicle_id,
                os_drustvo: this.os_drustvo,
                visina_premije: this.visina_premije,
                broj_polise: this.broj_polise,
                datum_isticanja_osiguranja: moment(this.datum_isticanja_osiguranja).add(1, 'year').format('Y-MM-DD')
            }

            store.dispatch('saveNewInsurance', data);
            this.show_notifications ? this.$awn.success('Uspešno dodato novo osiguranje') : false;
        },

        newKasko(vehicle_id) {

            let data = {
                vehicle_id : vehicle_id,
                os_drustvo_kasko: this.os_drustvo_kasko,
                visina_premije_kasko: this.visina_premije_kasko,
                broj_polise_kasko: this.broj_polise_kasko,
                datum_isticanja_kasko: this.datum_isticanja_kasko
            }

            store.dispatch('saveNewKasko', data);
            this.show_notifications ? this.$awn.success('Uspešno dodato novo kasko osiguranje') : false;

        }

    }
}
</script>



<style scoped>

</style>
