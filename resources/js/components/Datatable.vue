<template>
    <div class="row">
        <div class="col-md-4 mb-2">
            <div class="form-inline">
                <label class="mr-2">Showing</label>
                <select class="form-control" v-model="meta.per_page" @change="loadPerPage">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
                <label class="ml-2">Entries</label>
            </div>
        </div>
        <div class="col-md-4 offset-md-4">
            <div class="form-inline float-right">
                <label class="mr-2">Search</label>
                <input type="text" class="form-control" @input="search">
            </div>
        </div>
        <div class="col-md-12">
            <b-table striped hover :items="items" :fields="fields" :sort-by.sync="sortBy" :sort-desc.sync="sortDesc" show-empty>
                <template v-slot:cell(actions)="row">
                    <a :href="editUrl" v-if="editUrl" class="btn btn-warning btn-sm">Edit</a>
                    <button class="btn btn-danger btn-sm" @click="openDeleteModal(row)">Delete</button>
                </template>
            </b-table>
        </div>
        <div class="col-md-6">
            <p>Showing {{ meta.from }} to {{ meta.to }} of {{ meta.total }} items</p>
        </div>
        <div class="col-md-6">
            <b-pagination
                v-model="meta.current_page"
                :total-rows="meta.total"
                :per-page="meta.per_page"
                align="right"
                @change="changePage"
                aria-controls="dw-datatable"
            ></b-pagination>
        </div>

        <b-modal v-model="deleteModal" :title="title">
            <p>Kamu yakin ingin menghapus data ini?</p>
            <template v-slot:modal-footer>
                <div class="w-100 float-right">
                    <b-button
                        variant="secondary"
                        size="sm"
                        @click="deleteModal=false"
                    >
                        Close
                    </b-button>
                    <b-button
                        variant="primary"
                        size="sm"
                        @click="deleteModalButton"
                    >
                        Delete
                    </b-button>
                </div>
            </template>
        </b-modal>
    </div>
</template>

<script>
import _ from 'lodash'

export default {
    props: {
        items: {
            type: Array,
            required: true
        },
        fields: {
            type: Array,
            required: true
        },
        meta: {
            required: true
        },
        title: {
            type: String,
            default: "Delete Modal"
        },
        editUrl: {
            type: String,
            default: null
        }
    },
    data() {
        return {
            sortBy: null,
            sortDesc: false,
            deleteModal: false,
            selected: null
        }
    },
    watch: {
        sortBy(val) {
            this.$emit('sort', {
                sortBy: this.sortBy,
                sortDesc: this.sortDesc
            })
        },
        sortDesc(val) {
            this.$emit('sort', {
                sortBy: this.sortBy,
                sortDesc: this.sortDesc
            })
        }
    },
    methods: {
        loadPerPage(val) {
            this.$emit('per_page', this.meta.per_page)
        },
        changePage(val) {
            this.$emit('pagination', val)
        },
        search: _.debounce(function (e) {
            this.$emit('search', e.target.value)
        }, 500),
        openDeleteModal(row) {
            this.deleteModal = true
            this.selected = row.item
        },
        deleteModalButton() {
            this.$emit('delete', this.selected)
            this.deleteModal = false
        }
    }
}
</script>
