<template>
    <div>


          <!-- Page-body start -->
                   <div class="page-body" v-if="hide_form">
                    <!-- DOM/Jquery table start -->
                    <div class="card">
                        <div class="card-header">
                            <h2>Forma za snimanje novog vozila u bazu podataka</h2>
                        </div>

                        <div class="card-block">


<form class="j-pro" id="j-pro">
<!-- end /.header-->
<div class="j-content">
<!-- start name -->
    <div class="j-row">

        <!-- Vozilo -->
        <div class="j-span3 j-unit">
            <div class="j-input">
            <label class="j-icon-right" for="vozilo">
            <i class="icofont icofont-car-alt-1"></i>
            </label>
            <input type="text" placeholder="Vozilo" id="vozilo" name="vozilo" v-model="vozilo">
            <span class="text-danger" v-if="errors.vozilo">{{ errors.vozilo[0] }}</span>
            </div>
        </div>

        <!-- Registarski broj -->
        <div class="j-span2 j-unit">
            <div class="j-input">
            <label class="j-icon-right" for="reg_broj">
            <i class="icofont icofont-car-alt-1"></i>
            </label>
            <input type="text" placeholder="Registarski broj" id="reg_broj" name="reg_broj" v-model="reg_broj">
            <span class="text-danger" v-if="errors.reg_broj">{{ errors.reg_broj[0] }}</span>
            </div>
        </div>

        <!-- Inventarni broj -->
        <div class="j-span3 j-unit">
            <div class="j-input">
            <label class="j-icon-right" for="reg_broj">
            <i class="icofont icofont-car-alt-1"></i>
            </label>
            <input type="text" placeholder="Inv. broj" id="inv_broj" name="inv_broj" v-model="inv_broj">
            <span class="text-danger" v-if="errors.inv_broj">{{ errors.inv_broj[0] }}</span>
            </div>
        </div>


             <!-- Godina proizvodnje -->
        <div class="j-span2 j-unit">
            <div class="j-input">
            <label class="j-icon-right" for="godina_proizvodnje">
            <i class="icofont icofont-car-alt-1"></i>
            </label>
            <input type="text" placeholder="Godina proizvodnje" id="godina_proizvodnje" name="godina_proizvodnje" v-model="godina_proizvodnje">
            <span class="text-danger" v-if="errors.godina_proizvodnje">{{ errors.godina_proizvodnje[0] }}</span>
            </div>
        </div>


           <!-- Radna zapremina -->
        <div class="j-span2 j-unit">
            <div class="j-input">
            <label class="j-icon-right" for="radna_zapremina">
            <i class="icofont icofont-car-alt-1"></i>
            </label>
            <input type="text" placeholder="Radna zapremina" id="radna_zapremina" name="radna_zapremina" v-model="radna_zapremina">
            </div>
        </div>


        <!-- Broj motora -->
        <div class="j-span3 j-unit">
            <div class="j-input">
            <label class="j-icon-right" for="broj_motora">
            <i class="icofont icofont-car-alt-1"></i>
            </label>
            <input type="text" placeholder="Broj motora" id="broj_motora" name="broj_motora" v-model="broj_motora">
            </div>
        </div>

        <!-- Broj sasije -->
        <div class="j-span3 j-unit">
            <div class="j-input">
            <label class="j-icon-right" for="broj_sasije">
            <i class="icofont icofont-car-alt-1"></i>
            </label>
            <input type="text" placeholder="Broj šasije" id="broj_sasije" name="broj_sasije" v-model="broj_sasije">
            </div>
        </div>


        <!-- Dozvoljena nosivost -->
        <div class="j-span2 j-unit">
            <div class="j-input">
            <label class="j-icon-right" for="dozvoljena_nosivost">
            <i class="icofont icofont-car-alt-1"></i>
            </label>
            <input type="text" placeholder="Dozvoljena nosivost" id="dozvoljena_nosivost" name="dozvoljena_nosivost" v-model="dozvoljena_nosivost">
            </div>
        </div>

           <!-- KS -->
        <div class="j-span2 j-unit">
            <div class="j-input">
            <label class="j-icon-right" for="ks">
            <i class="icofont icofont-car-alt-1"></i>
            </label>
            <input type="text" placeholder="KS" id="ks" name="ks" v-model="ks">
            </div>
        </div>




    </div>

    <hr class="fancy">

     <div class="j-row">

        <!-- Os drustvo -->
        <div class="j-span3 j-unit">
            <label class="j-input j-select" for="os_drustvo">
            <select name="os_drustvo">
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
            <div class="j-input">
            <label class="j-icon-right" for="datum_isticanja_osiguranja">
            <i class="icofont icofont-ui-calendar"></i>
            </label>

            <datepicker v-model="datum_isticanja_osiguranja" name="datum_isticanja_osiguranja" format="dd MMM YYYY" :language="sr" input-class="form-control" calendar-button-icon="fa fa-calendar"></datepicker>
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
<button class="btn btn-primary" @click.prevent="saveVehicle"><i class="icofont icofont-car-alt-1"></i> Snimi vozilo</button>
<button type="reset" class="btn btn-default m-r-20" @click.prevent="resetForm">Reset</button>
</div>
<!-- end /.footer -->
</form>



                        </div>

                    </div>

                   </div>

    </div>
</template>



<script>
import store from '../../store/store';
import { mapState } from 'vuex';
import Datepicker from 'vuejs-datepicker';
import {sr} from 'vuejs-datepicker/dist/locale';

export default {
    components: {
        Datepicker,
    },

    data() {
        return {
            sr:sr,
            vozilo: '',
            reg_broj: '',
            broj_motora: '',
            dozvoljena_nosivost: '',
            broj_sasije: '',
            godina_proizvodnje: '',
            ks: '',
            radna_zapremina: '',
            broj_sedista: '',
            inv_broj: '',
            os_drustvo: '',
            datum_isticanja_osiguranja: '',
            visina_premije: '',
            registracija: '',
            broj_polise: '',

        }

    },


    computed: {

        ...mapState({
            hide_form: state => state.hide_vehicle_form,
            errors: state => state.errors,
        }),

    },

    methods: {

        saveVehicle()
        {

            let data = {
                vozilo: this.vozilo,
                reg_broj: this.reg_broj,
                broj_motora: this.vobroj_motorazilo,
                dozvoljena_nosivost: this.dozvoljena_nosivost,
                broj_sasije: this.broj_sasije,
                godina_proizvodnje: this.godina_proizvodnje,
                ks: this.ks,
                radna_zapremina: this.radna_zapremina,
                broj_sedista: this.broj_sedista,
                inv_broj: this.inv_broj,
                os_drustvo: this.os_drustvo,
                datum_isticanja_osiguranja: this.datum_isticanja_osiguranja,
                visina_premije: this.visina_premije,
                broj_polise: this.broj_polise,
            };

            store.dispatch('saveVehicle', data); // save vehicle vuex actions
        },

        resetForm()
        {

            this.vozilo = '';
            this.reg_broj = '';
            this.broj_motora = '';
            this.dozvoljena_nosivost = '';
            this.broj_sasije = '';
            this.godina_proizvodnje = '';
            this.ks = '';
            this.radna_zapremina = '';
            this.broj_sedista = '';
            this.inv_broj = '';
            this.os_drustvo = '';
            this.datum_isticanja_osiguranja = '';
            this.visina_premije = '';
            this.broj_polise = '';

        }

    }

}
</script>



<style scoped>

hr.fancy {
    border: 0;
    border-bottom: 1px dashed #ccc;
    background: rgb(216, 16, 16);
    margin-bottom: 30px;
}

</style>
