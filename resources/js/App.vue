<template>
    <div class="container" style="padding-top: 30px">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Data User</h5>
                    </div>
                    <div class="card-body">
                        <app-datatable
                            :items="items"
                            :fields="fields"
                            :meta="meta"
                            :editUrl="'/a/b'"
                            :title="'Delete Posts'"
                            @per_page="handlePerPage"
                            @pagination="handlePagination"
                            @search="handleSearch"
                            @sort="handleSort"
                            @delete="handleDelete"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Datatable from './components/Datatable.vue'
import axios from 'axios'

export default {
    created() {
        this.loadPostsData()
    },
    data() {
        return {
            fields: [
                {key: 'name', sortable: true},
                {key: 'email', sortable: true},
                {key: 'ktp_no', sortable: true},
                {key: 'addres', sortable: true},
            ],
            items: [],
            meta: [],
            current_page: 1,
            per_page: 10,
            search: '',
            sortBy: 'created_at',
            sortByDesc: false
        }
    },
    components: {
        'app-datatable': Datatable
    },
    methods: {
        loadPostsData() {
            let current_page = this.search == '' ? this.current_page:1
            axios.get(`/api/user`, {
                params: {
                    page: current_page,
                    per_page: this.per_page,
                    q: this.search,
                    sortby: this.sortBy,
                    sortbydesc: 'DESC'
                }
            })
            .then((response) => {
                let getData = response.data.data
                this.items = getData.data
                this.meta = {
                    total: getData.total,
                    current_page: getData.current_page,
                    per_page: getData.per_page,
                    from: getData.from,
                    to: getData.to
                }
            })
        },
        deletePostData(id) {
            axios.delete(`/api/user/${id}`).then(() => this.loadPostsData())
        },
        handlePerPage(val) {
            this.per_page = val
            this.loadPostsData()
        },
        handlePagination(val) {
            this.current_page = val
            this.loadPostsData()
        },
        handleSearch(val) {
            this.search = val
            this.loadPostsData()
        },
        handleSort(val) {
            this.sortBy = val.sortBy
            this.sortByDesc = val.sortDesc

            this.loadPostsData()
        },
        handleDelete(val) {
            this.deletePostData(val.id)
        }
    }
}
</script>
