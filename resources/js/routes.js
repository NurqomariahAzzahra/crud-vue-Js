import Dosen from './components/Dosens.vue';
import AddDosen from './components/Adddosen.vue';
export const routes = [{
        name: 'dosen',
        path: '/vue/dosen',
        component: Dosen
    },
    {
        name: 'dosen.create',
        path: '/vue/dosen/create',
        component: AddDosen
    },
    {
        name: 'dosen.edit',
        path: '/vue/dosen/edit/:id',
        component: AddDosen
    }
];