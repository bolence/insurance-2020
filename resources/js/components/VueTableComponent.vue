<template>


<div>

<button class="btn hor-grd btn-grd-primary mb-3 text-white" @click.prevent="$store.commit('show_vehicle_form')"><i class="fa fa-car"></i> {{ button_title }}</button>
<AddNewVehicleForm></AddNewVehicleForm>


<div v-show="show_vehicle_table">
<b-container fluid>
<!-- <br> -->
<b-row>
      <b-col sm="3" md="3" class="my-1" >
        <b-form-group
          label="Limit"
          label-cols-sm="2"
          label-cols-md="2"
          label-align-sm="right"
          label-size="sm"
          align="left"
          label-for="perPageSelect"
          class="mb-0">

        <b-form-select
            v-model="perPage"
            id="perPageSelect"
            size="md"
            :options="pageOptions">
        </b-form-select>
        </b-form-group>
      </b-col>
<b-col cols="5">
        <b-form-group
          label="Sortiraj"
          label-cols-sm="3"
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
</b-col>
<b-col sm="12" md="4" class="my-0">
        <b-form-group
          label="Filter"
          label-cols-sm="3"
          label-align-sm="right"
          label-size="sm"
          label-for="filterInput"
          class="mb-0"
        >
          <b-input-group size="md">
            <b-form-input
              v-model="filter"
              type="search"
              id="filterInput"
              align="fill"
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
      stacked="md"
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
        <a href="" class="edit" @click.prevent="editVehicle(row.item)"><i class="material-icons" data-toggle="tooltip" >&#xE254;</i></a>
        <a href="" class="delete" @click.prevent="deleteVehicle(row.item, row.index)"><i class="material-icons" data-toggle="tooltip">&#xE872;</i></a>
        <!-- <b-button size="sm" @click="info(row.item, row.index, $event.target)" class="mr-1" align="right;">
          Info modal
        </b-button> -->
        <!-- <b-button size="sm" @click="row.toggleDetails">
          {{ row.detailsShowing ? 'Hide' : 'Show' }} Details
        </b-button> -->
      </template>

      <template v-slot:row-details="row">
        <b-card-group deck>
           <b-card
            style="max-width: 30rem;"
            border-variant="primary"
            header="Tehničke karakteristike"
            header-bg-variant="primary"
            header-text-variant="white"
            align="center" class="text-center mb-3">
            <b-card-text>
                <ul style="font-size: 15px;">
                    <li>ID: {{ row.item.id }}</li>
                    <li>Vozilo: {{ row.item.vozilo }}</li>
                    <li>Regist.broj: {{ row.item.reg_broj }}</li>
                    <li>Broj motora: {{ row.item.broj_motora }}</li>
                    <li>Broj sasije: {{ row.item.broj_sasije }}</li>
                    <li>Godina proizvodnje: {{ row.item.godina_proizvodnje }}</li>
                    <li>KS: {{ row.item.ks }}</li>
                    <li>Radna zapremina: {{ row.item.radna_zapremina }}</li>
                    <li>Dozvoljena nosivost: {{ row.item.dozvoljena_nosivost }}</li>
                    <li>Broj sedista: {{ row.item.broj_sedista }}</li>
                    <!-- <li v-for="(value, key) in row.item"  :key="key">{{ key }}: {{ row.item.id }}</li> -->
                </ul>
            </b-card-text>
        </b-card>
        <b-card
            style="max-width: 30rem;"
            border-variant="success"
            header="Osiguranje"
            header-bg-variant="success"
            header-text-variant="white"
            align="center" class="text-center mb-3">
             <ul style="font-size: 15px;">
                <li>OS drustvo: {{ row.item.insurance.os_drustvo }}</li>
                <li>Broj polise: {{ row.item.insurance.broj_polise }}</li>
                <li>Visina premije: {{ row.item.insurance.visina_premije }}</li>
                <li>Datum isticanja osiguranja: {{ row.item.insurance.datum_isticanja_osiguranja | formatDate }}</li>
            <!-- <li v-for="(value, key) in row.item"  :key="key">{{ key }}: {{ row.item.id }}</li> -->
            </ul>
        </b-card>
        </b-card-group>
      </template>
    </b-table>

    <b-row>

    <b-col md="4" class="my-2">
      <span class="label label-success">Strana: {{ currentPage }} | Ukupno redova: {{ totalRows }}</span>
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
        <table class="table-md table-bordered table-striped">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">Handle</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                   <td>{{ infoModal.vehicle.vozilo }}</td>
                   <td></td>
                   <td></td>
                   <td></td>
                </tr>
            </tbody>
        </table>
      <!-- <pre>{{ infoModal.content }}</pre> -->
    </b-modal>
  </b-container>
  </div>
  </div>
</template>

<script>

import store from '../store/store';
import AddNewVehicleForm from '../components/forms/AddNewVehicle';
import { mapState } from 'vuex'
import moment from 'moment'

  export default {
    components: {
        AddNewVehicleForm,
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
        //   { key: 'godina_proizvodnje', label: 'Godina proiz.', class: 'text-center'},
          { key: 'insurance.os_drustvo', label: 'Os.društvo', class: 'text-center'},
          {
              key: 'insurance.datum_isticanja_osiguranja',
              sortDirection: 'desc',
              sortable: true,
               formatter: value => {
                return moment(String(value)).format('DD.MM.YYYY');
                },
              label: 'Datum osiguranja',
              class: 'text-center'},
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
          vehicle: ''
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
            hide_form: state => state.hide_vehicle_form,
            items: state => state.vehicles,
            totalRows: state => state.vehiclesCount,
            button_title: state => state.button_title_add_new_vehicle,
            show_vehicle_table: state => state.show_vehicle_table,
        })

    },
    mounted() {
        store.dispatch('fetchVehicles');
    },
    methods: {
      info(item, index, button) {
        this.infoModal.title = `Vozilo: ${item.reg_broj}`
        this.infoModal.vehicle = item;
        this.$root.$emit('bv::show::modal', this.infoModal.id, button)
      },
      resetInfoModal() {
        this.infoModal.title = ''
        this.infoModal.vehicle = ''
      },
      onFiltered(filteredItems) {
        store.commit('setVehiclesCount', filteredItems.length);
        this.currentPage = 1
      },

      deleteVehicle(vehicle, index){
          this.items.splice(index, 1);
          store.dispatch('deleteVehicle', vehicle.id);
      },

      saveVehicle()
      {

        let data = {
          vozilo: this.vozilo,
          reg_broj: this.reg_broj,
          broj_motora: this.broj_motora
        }

        this.items.unshift(data);
      }
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

.material-icons {
font-size: 18px;
}
</style>
