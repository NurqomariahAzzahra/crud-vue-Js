<template>
    <div >
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse">
                <div class="navbar-nav">
                    <router-link to="/vue/dosen" class="nav-item nav-link">Data Dosen</router-link>
                    <router-link to="/vue/dosen/create" class="nav-item nav-link">Create Data</router-link>
                </div>
            </div>
        </nav>

        <router-view> </router-view>
    </div>
</template>