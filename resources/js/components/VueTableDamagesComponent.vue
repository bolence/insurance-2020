<template>


<div>
<button class="btn hor-grd btn-grd-primary mb-3 text-white" @click.prevent="$store.commit('showVehicleForm')"><i class="fa fa-ambulance"></i> {{ button_title_add_new_damage }}</button>
<!-- <button class="btn hor-grd btn-grd-primary mb-3 text-white" @click.prevent="$store.dispatch('showVehicleType', null)" v-show="not_all_vehicle"><i class="fa fa-car"></i> Sva vozila</button>
<button class="btn hor-grd btn-grd-success mb-3 text-white" @click.prevent="$store.dispatch('showVehicleType', 'kasko')"><i class="fa fa-anchor"></i> Vozila sa kasko osiguranjem </button>
<button class="btn hor-grd btn-grd-danger mb-3 text-white" @click.prevent="$store.dispatch('showVehicleType', 'damage')"><i class="fa fa-ambulance"></i> Vozila sa štetama</button> -->
<AddNewDamageForm></AddNewDamageForm>
<!-- <EditVehicleForm></EditVehicleForm> -->


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
     :tbody-tr-class="rowClass"
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
        <a href="" class="view" @click.prevent="info(row.item, row.index, $event.target)"><i class="material-icons" data-toggle="tooltip">&#xE417;</i></a>
        <a href="" class="edit" @click.prevent="editDamage(row.item, row.index)"><i class="material-icons" data-toggle="tooltip" >&#xE254;</i></a>
        <a href="" class="delete" @click.prevent="deleteDamage(row.item, row.index)"><i class="material-icons" data-toggle="tooltip">&#xE872;</i></a>
      </template>

    </b-table>

    <b-row>

    <b-col md="4" class="my-2">
      <span class="label label-success">Strana: {{ currentPage }} | Ukupno redova: {{ totalRows }} | Po strani: {{ perPage }}</span>
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
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                <th scope="col">Servis</th>
                <th scope="col">Broj štete</th>
                <th scope="col">Naplaćeno</th>
                <th scope="col">Način naplate</th>
                <th scope="col">Izvršeno od</th>
                </tr>
            </thead>

            <tbody >
                <tr>
                   <td>{{ infoModal.damages.servis }}</td>
                   <td>{{ infoModal.damages.broj_stete }}</td>
                   <td>{{ infoModal.damages.naplaceno }}</td>
                   <td>{{ infoModal.damages.nacin_naplate }}</td>
                   <td>{{ infoModal.damages.izvrseno_od }}</td>
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
import AddNewDamageForm from '../components/forms/AddNewDamage';
// import EditVehicleForm from '../components/forms/EditVehicleForm';
import { mapState } from 'vuex';
import moment from 'moment';
import numeral from 'numeral';

  export default {
    components: {
        AddNewDamageForm,
        // EditVehicleForm,
    },
    data() {
      return {
        fields: [
          { key: 'vehicle.reg_broj', label: 'Vozilo', sortable: true, sortDirection: 'desc' },
          { key: 'ime_vozaca', label: 'Ime vozača', sortable: true, sortDirection: 'desc' },
          { key: 'mesto_udesa', label: 'Mesto udesa', sortable: true, class: 'text-center', status: 'awesome' },
          {
            key: 'datum_udesa',
            sortDirection: 'desc',
            sortable: true,
            formatter: value => {
            return moment(String(value)).format('DD.MM.YYYY');
            },
            label: 'Datum osiguranja',
            class: 'text-center'
          },
          { key: 'opis', label: 'Opis udesa', class: 'text-center'},
          { key: 'kriv', label: 'Kriv', class: 'text-center'},
           {
            key: 'iznos_stete',
            sortDirection: 'desc',
            sortable: true,
            formatter: value => {
            return numeral(value).format("0,0.00");
            },
            label: 'Iznos štete',
            class: 'text-center'
          },
          { key: 'actions', label: 'Actions', class: 'text-center' }
        ],
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
            items: state => state.damages,
            totalRows: state => state.damagesCount,
            button_title: state => state.button_title_add_new_vehicle,
            show_vehicle_table: state => state.show_vehicle_table,
            hide_form: state => state.show_edit_vehicle_form,
            button_title_add_new_damage: state => state.button_title_add_new_damage,
        })

    },
    mounted() {
        store.dispatch('fetchDamages', null);
    },

    methods: {

      rowClass(item, type) {
        if (!item) return
        if (item.kriv == 'DA') return 'table-danger'
      },
      info(item, index, button) {
        this.infoModal.title = `Detalji štete reg.broj: ${item.vehicle.reg_broj}`
        this.infoModal.damages = item;
        this.$root.$emit('bv::show::modal', this.infoModal.id, button)
      },
      resetInfoModal() {
        this.infoModal.title = ''
        this.infoModal.damages = ''
      },
      onFiltered(filteredItems) {
        store.commit('setDamagesCount', filteredItems.length);
        this.currentPage = 1
      },

      editDamage(damage) {
          store.dispatch('showEditVehicleForm', vehicle);
      },

      deleteDamage(damage, index){
          this.items.splice(index, 1);
          store.dispatch('deleteDamage', damage.id);
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
