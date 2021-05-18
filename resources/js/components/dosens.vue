<template>
    <div>
        <h2>Data Dosen</h2>
        <div class="col-lg-6 ">
            <div class="row">
            <div class="col-xs-8">
                <input type="text" class="form-control" v-model="s">
            </div>
            <div class="col-xs-4">
                <button class="btn btn-primary" @click="searchData">Cari</button>
            </div>
            </div>
            <hr>
        </div>
        <div class="col-lg-12">
            <table class="table">
                <thead>
                    <th>Nidn</th>
                    <th>Nama Dosen</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </thead>
                <tbody>
                     <tr  v-for="(item, index) in dosens.data" :key="index">
                         <td>{{ item.nidn}}</td>
                         <td>{{ item.nama}}</td>
                         <td>{{ item.alamat}}</td>
                         <td><div class="btn-group" role="group">
                                <router-link
                                    :to="{name: 'dosen.edit', params: { id: item.nidn }}"
                                    class="btn btn-success">Edit</router-link>
                                <button
                                    class="px-2 py-1 text-sm rounded text-red-600 border border-red-200 hover:text-white hover:bg-red-600"
                                    @click="deleteData(item.nidn)">Delete</button>
                            </div></td>
                     </tr>
                </tbody>
            </table>
            <pagination :data="dosens" @pagination-change-page="table" class="justify-center py-2"></pagination>
        </div>
    </div>
</template>
<script>
 export default {
        data() {
            return {
                dosens: {},
                msg:'',
                s:''
                }
        },
        created() {
            this.table();
        },
        methods: {
            table(page=1){
                this
                .axios
                .get('/api/dosen?page='+page+'&s='+this.s)
                .then(response => {
                    //this.msg = response.data.message;
                    this.dosens = response.data;

                });
            },
            deleteData(id) {
                this
                    .$swal
                    .fire({
                        title: 'Hapus Data?',
                        text: "Hapus Permanen",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Delete',
                        cancelButtonText: 'Batal'
                    })
                    .then((result) => {
                        if (result.value) {
                            let uri = `/api/dosen/${id}`;
                            this
                                .axios
                                .delete(uri)
                                .then(response => {
                                    this
                                    .$swal
                                    .fire(
                                        {title: 'Success!', text: 'Data deleted successfully', icon: 'success', timer: 1000}
                                    );
                                    this
                                        .dosens.data
                                        .splice(this.dosens.data.indexOf(id), 1);
                                        //this.table();
                                });
                        }
                    })
            },
            searchData(e){
                this.table();
            }
        }
    }
</script>
