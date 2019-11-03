<template>

<div v-show="hide_form">
  <b-card no-body>
    <b-tabs card>
      <b-tab title="Vozilo" active>
        <b-card-text>

<form class="j-pro" id="j-pro">
<!-- end /.header-->
<div class="j-content">
<!-- start name -->
    <div class="j-row">

        <!-- Vozilo -->
        <div class="j-span3 j-unit">
            <label class="j-label">Vozilo</label>
            <div class="j-input">
            <label class="j-icon-right" for="vozilo">
            <i class="icofont icofont-car-alt-1"></i>
            </label>
            <input type="text" placeholder="Vozilo" id="vozilo" name="vozilo" v-model="vehicle.vozilo">
            <span class="text-danger" v-if="errors.vozilo">{{ errors.vozilo[0] }}</span>
            </div>
        </div>

        <!-- Registarski broj -->
        <div class="j-span2 j-unit">
            <label class="j-label">Reg.broj</label>
            <div class="j-input">
            <label class="j-icon-right" for="reg_broj">
            <i class="icofont icofont-car-alt-1"></i>
            </label>
            <input type="text" placeholder="Registarski broj" id="reg_broj" name="reg_broj" v-model="vehicle.reg_broj">
            <span class="text-danger" v-if="errors.reg_broj">{{ errors.reg_broj[0] }}</span>
            </div>
        </div>

        <!-- Inventarni broj -->
        <div class="j-span3 j-unit">
            <label class="j-label">Inv.broj</label>
            <div class="j-input">
            <label class="j-icon-right" for="reg_broj">
            <i class="icofont icofont-car-alt-1"></i>
            </label>
            <input type="text" placeholder="Inv. broj" id="inv_broj" name="inv_broj" v-model="vehicle.inv_broj">
            <span class="text-danger" v-if="errors.inv_broj">{{ errors.inv_broj[0] }}</span>
            </div>
        </div>


             <!-- Godina proizvodnje -->
        <div class="j-span2 j-unit">
            <label class="j-label">Godina proizvodnje</label>
            <div class="j-input">
            <label class="j-icon-right" for="godina_proizvodnje">
            <i class="icofont icofont-car-alt-1"></i>
            </label>
            <input type="text" placeholder="Godina proizvodnje" id="godina_proizvodnje" name="godina_proizvodnje" v-model="vehicle.godina_proizvodnje">
            <span class="text-danger" v-if="errors.godina_proizvodnje">{{ errors.godina_proizvodnje[0] }}</span>
            </div>
        </div>


           <!-- Radna zapremina -->
        <div class="j-span2 j-unit">
            <label class="j-label">Radna zapremina</label>
            <div class="j-input">
            <label class="j-icon-right" for="radna_zapremina">
            <i class="icofont icofont-car-alt-1"></i>
            </label>
            <input type="text" placeholder="Radna zapremina" id="radna_zapremina" name="radna_zapremina" v-model="vehicle.radna_zapremina">
            </div>
        </div>


        <!-- Broj motora -->
        <div class="j-span3 j-unit">
            <label class="j-label">Broj motora</label>
            <div class="j-input">
            <label class="j-icon-right" for="broj_motora">
            <i class="icofont icofont-car-alt-1"></i>
            </label>
            <input type="text" placeholder="Broj motora" id="broj_motora" name="broj_motora" v-model="vehicle.broj_motora">
            </div>
        </div>

        <!-- Broj sasije -->
        <div class="j-span3 j-unit">
            <label class="j-label">Godina proizvodnje</label>
            <div class="j-input">
            <label class="j-icon-right" for="broj_sasije">
            <i class="icofont icofont-car-alt-1"></i>
            </label>
            <input type="text" placeholder="Broj šasije" id="broj_sasije" name="broj_sasije" v-model="vehicle.broj_sasije">
            </div>
        </div>


        <!-- Dozvoljena nosivost -->
        <div class="j-span2 j-unit">
            <label class="j-label">Dozvoljena nosivost</label>
            <div class="j-input">
            <label class="j-icon-right" for="dozvoljena_nosivost">
            <i class="icofont icofont-car-alt-1"></i>
            </label>
            <input type="text" placeholder="Dozvoljena nosivost" id="dozvoljena_nosivost" name="dozvoljena_nosivost" v-model="vehicle.dozvoljena_nosivost">
            </div>
        </div>

           <!-- KS -->
        <div class="j-span2 j-unit">
            <label class="j-label">KS</label>
            <div class="j-input">
            <label class="j-icon-right" for="ks">
            <i class="icofont icofont-car-alt-1"></i>
            </label>
            <input type="text" placeholder="KS" id="ks" name="ks" v-model="vehicle.ks">
            </div>
        </div>




    </div>

    <hr class="fancy">

     <div class="j-row" v-if="vehicle.insurance">

        <!-- Os drustvo -->
        <div class="j-span3 j-unit">
            <label class="j-label">Os.društvo</label>
            <label class="j-input j-select" for="os_drustvo">
            <select name="os_drustvo" v-model="vehicle.insurance.os_drustvo">
            <option value="" selected>Izaberi osiguranje</option>
            <option value="DUNAV">DUNAV</option>
            <option value="TRIGLAV">TRIGLAV</option>
            <option value="GENERALI">GENERALI</option>
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
            <input type="text" placeholder="Broj polise" id="broj_polise" name="broj_polise" v-model="vehicle.insurance.broj_polise">
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
            <input type="text" placeholder="Visina premije" id="visina_premije" name="visina_premije" v-model="vehicle.insurance.visina_premije">
            <span class="text-danger" v-if="errors.visina_premije">{{ errors.visina_premije[0] }}</span>
            </div>
        </div>


         <!-- Isticanje osiguranja -->
        <div class="j-span3 j-unit">
            <label class="j-label">Datum isticanja osiguranja</label>
            <div class="j-input">
            <label class="j-icon-right" for="datum_isticanja_osiguranja">
            <i class="icofont icofont-ui-calendar"></i>
            </label>

            <datepicker v-model="vehicle.insurance.datum_isticanja_osiguranja" name="datum_isticanja_osiguranja" format="dd MMM yyyy" :language="sr" input-class="form-control" calendar-button-icon="fa fa-calendar"></datepicker>
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
<button class="btn btn-primary" @click.prevent="updateVehicle(vehicle)"><i class="icofont icofont-car-alt-1"></i> Izmeni vozilo</button>
<button class="btn btn-default m-r-20" @click.prevent="$store.commit('hideEditForm')">Zatvori</button>
</div>
<!-- end /.footer -->
</form>

        </b-card-text>
      </b-tab>


      <b-tab title="Kasko">
        <b-card-text>
            <div class="card">
                        <div class="card-header">
                            <h2>Izmeni/dodaj kasko osiguranje</h2>
                        </div>

                        <div class="card-block">

<form class="j-pro" id="j-pro" v-if="hide_form">
<!-- end /.header-->
<div class="j-content">

     <div class="j-row">

      <!-- Os drustvo kasko -->
        <div class="j-span3 j-unit">
            <label class="j-label">Os drustvo kasko</label>
            <div class="j-input">
            <label class="j-icon-right" for="visina_premije">
            <i class="icofont icofont-car-alt-1"></i>
            </label>
            <input type="text" id="os_drustvo_kasko" name="os_drustvo_kasko" v-model="vehicle.kasko.os_drustvo_kasko" v-if="vehicle.kasko !== null">
            <input type="text" placeholder="Broj polise" id="os_drustvo_kasko" name="os_drustvo_kasko" v-model="os_drustvo_kasko" v-else>
            </div>
        </div>


         <!--Broj polise kasko -->
        <div class="j-span3 j-unit">
              <label class="j-label">Broj polise kasko</label>
            <div class="j-input">
            <label class="j-icon-right" for="broj_polise_kasko">
            <i class="icofont icofont-car-alt-1"></i>
            </label>
            <input type="text" id="broj_polise_kasko" name="broj_polise_kasko" v-model="vehicle.kasko.broj_polise_kasko" v-if="vehicle.kasko !== null">
            <input type="text" placeholder="Broj polise kasko" id="broj_polise_kasko" name="broj_polise_kasko" v-model="broj_polise_kasko" v-else>
            </div>
        </div>


         <!-- Visina premije kasko -->
        <div class="j-span3 j-unit">
               <label class="j-label">Visina premije kasko</label>
            <div class="j-input">
            <label class="j-icon-right" for="visina_premija_kasko">
            <i class="icofont icofont-car-alt-1"></i>
            </label>
            <input type="text" id="visina_premija_kasko" name="visina_premija_kasko" v-model="vehicle.kasko.visina_premije_kasko" v-if="vehicle.kasko !== null">
            <input type="text" placeholder="Visina premije kasko" id="visina_premija_kasko" name="visina_premija_kasko" v-model="visina_premije_kasko" v-else>

            </div>
        </div>


         <!-- Isticanje osiguranja -->
        <div class="j-span3 j-unit">
            <label class="j-label">Datum isticanja kaska</label>
            <div class="j-input">
            <label class="j-icon-right" for="datum_isticanja_kasko">
            <i class="icofont icofont-car-alt-1"></i>
            </label>
            <datepicker v-model="vehicle.kasko.datum_isticanja_kasko" v-if="vehicle.kasko !== null" name="datum_isticanja_kasko" format="dd MMM yyyy" :language="sr" input-class="form-control" calendar-button-icon="fa fa-calendar"></datepicker>
            <datepicker v-model="datum_isticanja_kasko" v-else name="datum_isticanja_kasko" format="dd MMM yyyy" :language="sr" input-class="form-control" calendar-button-icon="fa fa-calendar"></datepicker>

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
<button class="btn btn-primary" @click.prevent="updateVehicle(vehicle)"><i class="icofont icofont-car-alt-1"></i> Snimi</button>
<button class="btn btn-default m-r-20" @click.prevent="$store.commit('hideEditForm')">Zatvori</button>
</div>
<!-- end /.footer -->
</form>



                        </div>

                    </div>

        </b-card-text>
      </b-tab>


       <b-tab title="Fajlovi">
        <b-card-text>
              <ul>
                    <li v-for="(file, index) in vehicle.files" :key="index">
                        <i class="fa fa-file-pdf-o"></i>
                        <a :href="`uploads/${file.vehicle_id}/${file.filename}`"> {{ file.filename }}</a>
                        <a href="" @click.prevent="removeFile(file.id, index)" title="Izbriši fajl"> <i class="fa fa-trash" style="color:red;"></i> </a>
                    </li>
                    </ul>
              <vue-dropzone
                ref="myVueDropzone"
                id="dropzone"
                :options="dropzoneOptions"
                v-on:vdropzone-sending="sendingEvent"
                v-on:vdropzone-success="afterSuccessUpload"
                ></vue-dropzone>
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
import vue2Dropzone from 'vue2-dropzone'
import 'vue2-dropzone/dist/vue2Dropzone.min.css'

export default {

    components: {
        Datepicker,
        vueDropzone: vue2Dropzone,
    },

    data() {
        return {
            os_drustvo_kasko: '',
            visina_premije_kasko: '',
            datum_isticanja_kasko: '',
            broj_polise_kasko: '',
            sr: sr,
            dropzoneOptions: {
            url: '/api/files',
            thumbnailWidth: 50,
            maxFilesize: 10,
            addRemoveLinks: true,
            dictDefaultMessage: "<i class='fa fa-cloud-upload'></i>UPLOAD ME",
        }
    }
    },

    computed: {
         ...mapState({
            hide_form: state => state.show_edit_vehicle_form,
            vehicle: state => state.vehicle,
            errors: state => state.errors,
        })
    },

    mounted() {

    },

    methods: {

        updateVehicle(vehicle) {
            let data = {
                id: vehicle.id,
                vozilo: vehicle.vozilo,
                reg_broj: vehicle.reg_broj,
                broj_motora: vehicle.broj_motora,
                dozvoljena_nosivost: vehicle.dozvoljena_nosivost,
                broj_sasije: vehicle.broj_sasije,
                godina_proizvodnje: vehicle.godina_proizvodnje,
                ks: vehicle.ks,
                radna_zapremina: vehicle.radna_zapremina,
                broj_sedista: vehicle.broj_sedista,
                inv_broj: vehicle.inv_broj,
                os_drustvo: vehicle.insurance.os_drustvo,
                datum_isticanja_osiguranja: vehicle.insurance.datum_isticanja_osiguranja,
                visina_premije: vehicle.insurance.visina_premije,
                registracija: vehicle.insurance.registracija,
                broj_polise: vehicle.insurance.broj_polise,
                os_drustvo_kasko: vehicle.kasko.os_drustvo_kasko,
                visina_premije_kasko: vehicle.kasko.visina_premije_kasko,
                datum_isticanja_kasko: vehicle.kasko.datum_isticanja_kasko,
                broj_polise_kasko: vehicle.kasko.broj_polise_kasko,


            };
            store.dispatch('updateVehicle', data);
            this.$awn.success('Uspešno izmenjeno vozilo');
        },


        removeFile( vehicle_id, index ){
            this.vehicle.files.splice(index, 1);
            store.dispatch('removeFile', vehicle_id);
            this.$awn.success('Uspešno izbrisan fajl');
        },

        afterSuccessUpload(file, response ){
            // console.log(response.data);
            store.dispatch('uploadFiles', response.data);
            this.$awn.success(response.data.message);
        },

        sendingEvent (file, xhr, formData) {
            formData.append('vehicle_id', this.vehicle.id);
        },

    },

}
</script>

<style>

</style>
