<template>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        <h4>TAMBAH DATA</h4>
                        <hr>

                        <form @submit.prevent="store">
                            <div class="form-group">
                                <label for="nidn" class="font-weight-bold">NIDN</label>
                                <input type="text" class="form-control" v-model="dosen.nidn" placeholder="Masukkan NIDN">
                                <!-- validation -->
                                <div v-if="validation.nidn" class="mt-2 alert alert-danger">
                                    {{ validation.nidn[0] }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nama" class="font-weight-bold">Nama</label>
                                <input type="text" class="form-control" v-model="dosen.nama" placeholder="Masukkan Nama">
                                <!-- validation -->
                                <div v-if="validation.nama" class="mt-2 alert alert-danger">
                                    {{ validation.nama[0] }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="alamat" class="font-weight-bold">Alamat</label>
                                <textarea class="form-control" rows="4" v-model="dosen.alamat" placeholder="Masukkan Alamat"></textarea>
                                <!-- validation -->
                                <div v-if="validation.alamat" class="mt-2 alert alert-danger">
                                    {{ validation.alamat[0] }}
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>                        

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { reactive, ref } from 'vue'
import { useRouter } from 'vue-router'
import axios from 'axios'

export default {

    setup() {

        //state dosens
        const dosen = reactive({
            nidn: '',
            nama: '',
            alamat: ''
        })

        //state validation
        const validation = ref([])

        //vue router
        const router = useRouter()

        //method store
        function store() {
            let nidn   = dosen.nidn
            let nama   = dosen.nama
            let alamat = dosen.alamat

            axios.dosen('http://localhost:8000/api/dosen', {
                nidn: nidn,
                nama: nama,
                alamat: alamat
            }).then(() => {

                //redirect ke dosen index
                router.push({
                    name: 'dosen.index'
                })

            }).catch(error => {
                //assign state validation with error 
                validation.value = error.response.data
            })

        }

        //return
        return {
            dosen,
            validation,
            router,
            store
        }

    }

}
</script>

<style>
    body{
        background: lightgray;
    }
</style>