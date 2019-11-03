<template>


<div>
<button class="btn hor-grd btn-grd-primary mb-3 text-white" @click.prevent="$store.commit('showVehicleForm')"><i class="fa fa-car"></i> {{ button_title }}</button>
<button class="btn hor-grd btn-grd-primary mb-3 text-white" @click.prevent="$store.dispatch('showVehicleType', null)" v-show="not_all_vehicle"><i class="fa fa-car"></i> Sva vozila</button>
<button class="btn hor-grd btn-grd-success mb-3 text-white" @click.prevent="$store.dispatch('showVehicleType', 'kasko')"><i class="fa fa-anchor"></i> Vozila sa kasko osiguranjem </button>
<button class="btn hor-grd btn-grd-danger mb-3 text-white" @click.prevent="$store.dispatch('showVehicleType', 'damage')"><i class="fa fa-ambulance"></i> Vozila sa štetama</button>
<AddNewVehicleForm></AddNewVehicleForm>
<EditVehicleForm></EditVehicleForm>


<div v-show="show_vehicle_table">
<b-container fluid>
<!-- <br> -->
<b-row>
      <b-col lg="6" class="my-10" >
        <b-form-group
          label="Limit"
          label-cols-sm="1"
          label-cols-md="1"
          label-align-sm="left"
          label-size="sm"
          align="left"
          label-for="perPageSelect"
          class="mt-0">

        <b-form-select
            v-model="perPage"
            id="perPageSelect"
            size="lg"
            class="w-25 float-left"
            :options="pageOptions"
        >
        </b-form-select>
        </b-form-group>
      </b-col>
<!-- <b-col sm="6" md="6">
        <b-form-group
          label="Sortiraj"
          label-cols-sm="4"
          label-align-sm="right"
          label-size="sm"
          label-for="sortBySelect"
          class="mb-0">
          <b-input-group size="md">
            <b-form-select v-model="sortBy" id="sortBySelect" :options="sortOptions" class="w-75">
              <template v-slot:first>
                <option value="">-- none --</option>
              </template>
            </b-form-select>
            <b-form-select v-model="sortDesc" size="md" :disabled="!sortBy" class="w-25">
              <option :value="false">Asc</option>
              <option :value="true">Desc</option>
            </b-form-select>
          </b-input-group>
        </b-form-group>
</b-col> -->
<b-col lg="6" class="my-0">
        <b-form-group
          label="Filter"
          label-cols-sm="3"
          label-align-sm="right"
          label-size="sm"
          label-for="filterInput"
          class="mb-0"
        >
          <b-input-group>
            <b-form-input
              v-model="filter"
              type="search"
              id="filterInput"
              class="w-25"
              placeholder="Pretraga"
            ></b-form-input>
            <b-input-group-append>
              <b-button :disabled="!filter" @click="filter = ''">Izbriši</b-button>
            </b-input-group-append>
          </b-input-group>
        </b-form-group>
      </b-col>

</b-row>

    <!-- Main table element -->
    <b-table
      striped
      bordered
      responsive
      show-empty
      small
      head-variant="light"
      :items="items"
      :fields="fields"
      :current-page="currentPage"
      :per-page="perPage"
      :filter="filter"
      :filterIncludedFields="filterOn"
      :sort-by.sync="sortBy"
      :sort-desc.sync="sortDesc"
      :sort-direction="sortDirection"
      @filtered="onFiltered"
    >
      <template v-slot:cell(name)="row">
        {{ row.value.first }} {{ row.value.last }}
      </template>

      <template v-slot:cell(actions)="row">
        <!-- <a href="" class="view" @click.prevent="info(row.item, row.index, $event.target)"><i class="material-icons" data-toggle="tooltip">&#xE417;</i></a> -->
        <a href="" class="view" @click.prevent="row.toggleDetails"><i class="material-icons" data-toggle="tooltip">&#xE417;</i></a>
        <a href="" class="edit" @click.prevent="editVehicle(row.item, row.index)"><i class="material-icons" data-toggle="tooltip" >&#xE254;</i></a>
        <a href="" class="delete" @click.prevent="deleteVehicle(row.item, row.index)"><i class="material-icons" data-toggle="tooltip">&#xE872;</i></a>
        <a href="" class="kasko"><i class="fa fa-anchor" v-if="row.item.kasko" title="Vozilo ima kasko"></i></a>
        <a href="" class="damage" @click.prevent="info(row.item, row.index, $event.target)">
        <i class="material-icons" v-if="row.item.damage.length > 0" title="Vozilo ima štetu" data-toggle="tooltip">&#xE003;</i>
        <span v-if="type == 'damage'" title="Broj šteta">({{ row.item.damage.length }})</span>
        </a>

        <!-- <b-button size="sm" @click="info(row.item, row.index, $event.target)" class="mr-1" align="right;">
          Info modal
        </b-button> -->
        <!-- <b-button size="sm" @click="row.toggleDetails">
          {{ row.detailsShowing ? 'Hide' : 'Show' }} Details
        </b-button> -->
      </template>

      <template v-slot:row-details="row">
        <b-card-group deck>
           <b-card align="center" class="text-center mb-2">
               <b-text><h4>Detalji vozila</h4></b-text>
            <b-list-group>
                    <b-list-group-item><span class="font-bold">ID:</span> {{ row.item.id }}</b-list-group-item>
                    <b-list-group-item><span class="font-bold">Vozilo</span> {{ row.item.vozilo }}</b-list-group-item>
                    <b-list-group-item><span class="font-bold">Regist.broj</span> {{ row.item.reg_broj }}</b-list-group-item>
                    <b-list-group-item><span class="font-bold">Broj motora</span> {{ row.item.broj_motora }}</b-list-group-item>
                    <b-list-group-item><span class="font-bold">Broj šasije</span> {{ row.item.broj_sasije }}</b-list-group-item>
                    <b-list-group-item><span class="font-bold">Godina proizvodnje</span> {{ row.item.godina_proizvodnje }}</b-list-group-item>
                    <b-list-group-item><span class="font-bold">KS</span> {{ row.item.ks }}</b-list-group-item>
                    <b-list-group-item><span class="font-bold">Radna zapremina</span> {{ row.item.radna_zapremina }}</b-list-group-item>
                    <b-list-group-item><span class="font-bold">Dozvoljena nosivost</span> {{ row.item.dozvoljena_nosivost }}</b-list-group-item>
                    <b-list-group-item><span class="font-bold">Broj sedišta</span> {{ row.item.broj_sedista }}</b-list-group-item>

            </b-list-group>

        </b-card>
        <b-card align="center" class="text-center mb-2">
            <b-text><h4>Osiguranje</h4></b-text>
            <b-list-group>
                <b-list-group-item><span class="font-bold">OS društvo</span>: {{ row.item.insurance.os_drustvo }}</b-list-group-item>
                <b-list-group-item><span class="font-bold">Broj polise</span>: {{ row.item.insurance.broj_polise }}</b-list-group-item>
                <b-list-group-item><span class="font-bold">Visina premije</span>: {{ row.item.insurance.visina_premije }}</b-list-group-item>
                <b-list-group-item><span class="font-bold">Datum isticanja osiguranja</span>: {{ row.item.insurance.datum_isticanja_osiguranja | formatDate }}</b-list-group-item>
            </b-list-group>
            <!-- <li v-for="(value, key) in row.item"  :key="key">{{ key }}: {{ row.item.id }}</li> -->
        </b-card>

        <b-card align="center" class="text-center mb-2" v-if="row.item.kasko">
            <b-text><h4>Kasko</h4></b-text>
            <b-list-group>
                <b-list-group-item><span classs="font-bold">OS društvo kasko</span>: {{ row.item.kasko.os_drustvo_kasko }}</b-list-group-item>
                <b-list-group-item><span classs="font-bold">Broj polise kasko</span>: {{ row.item.kasko.broj_polise_kasko }}</b-list-group-item>
                <b-list-group-item><span classs="font-bold">Visina premije kasko</span>: {{ row.item.kasko.visina_premije_kasko }}</b-list-group-item>
                <b-list-group-item><span classs="font-bold">Datum isticanja kasko</span>: {{ row.item.kasko.datum_isticanja_kasko | formatDate }}</b-list-group-item>
            </b-list-group>
        </b-card>
        </b-card-group>
      </template>
    </b-table>

    <b-row>

    <b-col md="4" class="my-2">
      <span class="label label-success">Strana: {{ currentPage }} | Ukupno redova: {{ totalRows }} | Po strani: {{ perPage }}</span>
        <!-- <b-form-group
          label="Filter On"
          label-cols-sm="3"
          label-align-sm="right"
          label-size="sm"
          description="Leave all unchecked to filter on all data"
          class="my-0">
          <b-form-checkbox-group v-model="filterOn" class="mt-1">
            <b-form-checkbox value="name">Vozilo</b-form-checkbox>
            <b-form-checkbox value="age">Reg.broj</b-form-checkbox>
            <b-form-checkbox value="isActive">Broj motora</b-form-checkbox>
          </b-form-checkbox-group>
        </b-form-group> -->
    </b-col>

      <b-col sm="7" md="8" class="my-0">
        <b-pagination
          v-model="currentPage"
          :total-rows="totalRows"
          :per-page="perPage"
          align="right"
          size="md"
          class="my-1"
        ></b-pagination>
      </b-col>


    </b-row>

    <!-- Info modal -->
    <b-modal :id="infoModal.id" :title="infoModal.title" ok-only @hide="resetInfoModal" size="lg">
        <table class="table table-bordered table-striped table-responsive">
            <thead>
                <tr>
                <th scope="col">Šteta</th>
                <th scope="col">Ime vozača</th>
                <th scope="col">Mesto udesa</th>
                <th scope="col">Datum udesa</th>
                <th scope="col">Opis</th>
                <th scope="col">Kriv</th>
                <th scope="col">Servis</th>
                <th scope="col">Iznos štete</th>
                <th scope="col">Broj štete</th>
                <th scope="col">Naplaćeno</th>
                <th scope="col">Način naplate</th>
                <th scope="col">Izvršeno od</th>
                </tr>
            </thead>

            <tbody >
                <tr v-for="(damage, index) in infoModal.damages" :key="index">
                    <td>{{ index + 1 }}</td>
                   <td>{{ damage.ime_vozaca }}</td>
                   <td>{{ damage.mesto_udesa }}</td>
                   <td>{{ damage.datum_udesa | formatDate }}</td>
                   <td>{{ damage.opis }}</td>
                   <td>{{ damage.kriv }}</td>
                   <td>{{ damage.servis }}</td>
                   <td>{{ damage.iznos_stete }}</td>
                   <td>{{ damage.broj_stete }}</td>
                   <td>{{ damage.naplaceno }}</td>
                   <td>{{ damage.nacin_naplate }}</td>
                   <td>{{ damage.izvrseno_od }}</td>
                </tr>
            </tbody>
        </table>

    </b-modal>
  </b-container>
  </div>
  </div>
</template>

<script>

import store from '../store/store';
import AddNewVehicleForm from '../components/forms/AddNewVehicle';
import EditVehicleForm from '../components/forms/EditVehicleForm';
import { mapState } from 'vuex';
import moment from 'moment';

  export default {
    components: {
        AddNewVehicleForm,
        EditVehicleForm,
    },
    data() {
      return {
        vozilo: '',
        reg_broj: '',
        broj_motora: '',
        fields: [
          { key: 'vozilo', label: 'Vehicle', sortable: true, sortDirection: 'desc' },
          { key: 'reg_broj', label: 'Reg.broj', sortable: true, class: 'text-center', status: 'awesome' },
          { key: 'broj_motora', label: 'Broj motora', class: 'text-center'},
          { key: 'inv_broj', label: 'Inv. broj', class: 'text-center'},
          { key: 'broj_sasije', label: 'Broj šasije', class: 'text-center'},
          { key: 'insurance.os_drustvo', label: 'Os.društvo', class: 'text-center'},
          {
            key: 'insurance.datum_isticanja_osiguranja',
            sortDirection: 'desc',
            sortable: true,
            formatter: value => {
            return moment(String(value)).format('DD.MM.YYYY');
            },
            label: 'Datum osiguranja',
            class: 'text-center'
            },
          { key: 'actions', label: 'Actions', class: 'text-center' }
        ],
        // totalRows: 1,
        currentPage: 1,
        perPage: 25,
        pageOptions: [5, 10, 15, 25, 50, 100, 1000],
        sortBy: '',
        sortDesc: true,
        sortDirection: 'desc',
        filter: null,
        filterOn: [],
        infoModal: {
          id: 'info-modal',
          title: '',
          damages: ''
        }
      }
    },


    computed: {
      sortOptions() {
        // Create an options list from our fields
        return this.fields
          .filter(f => f.sortable)
          .map(f => {
            return { text: f.label, value: f.key }
          })
      },
        ...mapState({
            hide_form: state => state.showVehicleForm,
            items: state => state.vehicles,
            totalRows: state => state.vehiclesCount,
            button_title: state => state.button_title_add_new_vehicle,
            show_vehicle_table: state => state.show_vehicle_table,
            hide_form: state => state.show_edit_vehicle_form,
            vehicle: state => state.vehicle,
            not_all_vehicle: state => state.not_all_vehicle,
            type: state => state.type,
        })

    },
    mounted() {
        store.dispatch('fetchVehicles');
    },

    methods: {
      info(item, index, button) {
        //   console.log(item);
        this.infoModal.title = `Štete za vozilo reg.broj: ${item.reg_broj}`
        this.infoModal.damages = item.damage;
        this.$root.$emit('bv::show::modal', this.infoModal.id, button)
      },
      resetInfoModal() {
        this.infoModal.title = ''
        this.infoModal.damages = ''
      },
      onFiltered(filteredItems) {
        store.commit('setVehiclesCount', filteredItems.length);
        this.currentPage = 1
      },

      editVehicle(vehicle) {
          store.dispatch('showEditVehicleForm', vehicle);
      },

      deleteVehicle(vehicle, index){
          this.items.splice(index, 1);
          store.dispatch('deleteVehicle', vehicle.id);
      },

    //   saveVehicle()
    //   {

    //     let data = {
    //       vozilo: this.vozilo,
    //       reg_broj: this.reg_broj,
    //       broj_motora: this.broj_motora
    //     }

    //     this.items.unshift(data);
    //   }
    }
  }
</script>

<style scoped>
.text-white {
    color: white;
    font-weight: bolder;
    font-size: 15px;
}

table.table tr th, table.table tr td {
    border-color: #e9e9e9;
}


a.view {
    color: #03A9F4;
}
a.edit {
    color: #FFC107;
}
a.delete {
    color: #E34724;
}

a.kasko {
    color: rgb(101, 15, 106);
}

a.damage {
    color: rgb(9, 134, 148);
}

.font-bold {
    font-weight: bolder;
    font-style: italic;
}

.w500 {
    width: 900px;
}

.material-icons {
font-size: 18px;
}
</style>
