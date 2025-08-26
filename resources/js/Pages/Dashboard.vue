<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';
import {useForm} from "@inertiajs/vue3";
import SingleTableHeader from '@/Components/SingleTableHeader.vue';
import SingleTable from '@/Components/SingleTable.vue';
import Modal from '@/Components/Modal.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';



</script>

<template>
    <Head title="Tasks" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
            >
                Tasks
            </h2>

        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800"
                >
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <!-- Content -->
                        <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                            <div class="flex space-x-4 justify-between items-center px-4">
                                <div>
                                    <h1 class="text-white text-4xl my-4">Tasks</h1>

                                </div>
                                <div>

                                </div>
                            </div>

                            <SingleTableHeader>

                            </SingleTableHeader>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>

</template>
