<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue'
import axios from 'axios'

const tasks = ref([])
const title = ref('')
const error = ref('')

const getTasks = async () => {
    const res = await axios.get('/tasks')
    tasks.value = res.data
}

const addTask = async () => {
    if (!title.value.trim()) {
        error.value = "Task cannot be empty"
        return
    }
    await axios.post('/tasks', {
        title: title.value
    })

    title.value = ''
    getTasks()
}

const toggleTask = async (task) => {
    await axios.put(`/tasks/${task.id}`, {
        is_completed: !task.is_completed,
        title: task.title
    })
    getTasks()
}

const deleteTask = async (id) => {
    await axios.delete(`/tasks/${id}`)
    getTasks()
}


onMounted(getTasks)
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>

        <div class="flex justify-center py-12 bg-gradient-to-br from-blue-100 via-purple-100 to-pink-100 min-h-screen">

            <div class="w-full max-w-xl bg-white/80 backdrop-blur-xl p-8 rounded-3xl shadow-xl border border-white/40">

                <h1 class="text-2xl font-semibold text-gray-800 mb-8 text-center tracking-wide">
                    📝 My Tasks
                </h1>

                <div class="flex gap-3 mb-8">
                    <input 
                        v-model="title"
                        placeholder="What do you need to do?"
                        @input="error = ''"
                        :class="[ 'border p-3 rounded-xl w-full focus:outline-none focus:ring-2 transition',
                                error 
                                    ? 'border-red-500 focus:ring-red-400' 
                                    : 'border-gray-300 focus:ring-indigo-400'
                                ]"
                    />
                    <p v-if="error" class="text-red-500 text-sm mb-4 text-center">
                        {{ error }}
                    </p>

                    <button 
                        @click="addTask"
                        class="bg-indigo-600 text-white px-5 rounded-xl hover:bg-indigo-700 active:scale-95 transition font-medium"
                    >
                        Add
                    </button>
                </div>

                <p v-if="tasks.length === 0" class="text-center text-gray-400 mb-6 italic">
                    ✨ No tasks yet — start something!
                </p>

                <ul class="space-y-4">
                    <li 
                        v-for="task in tasks" 
                        :key="task.id"
                        class="flex justify-between items-center bg-white p-4 rounded-xl shadow-sm hover:shadow-md transition group"
                    >

                        <div class="flex items-center gap-4">

                            <input 
                                type="checkbox"
                                :checked="task.is_completed"
                                @change="toggleTask(task)"
                                class="w-4 h-4 accent-indigo-500"
                            />

                            <span 
                                :class="{ 'line-through text-gray-400': task.is_completed }"
                                class="text-gray-700 transition"
                            >
                                {{ task.title }}
                            </span>
                        </div>


                        <button 
                            @click="deleteTask(task.id)"
                            class="opacity-0 group-hover:opacity-100 text-red-400 hover:text-red-600 transition text-xl"
                        >
                            ×
                        </button>

                    </li>
                </ul>

            </div>
        </div>

    </AuthenticatedLayout>
</template>