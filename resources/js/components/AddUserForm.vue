<template>
  <div v-if="show" class="block fixed inset-0 w-full h-full overflow-x-hidden overflow-y-auto z-50 bg-black bg-opacity-50" @click="closeModal">
    <div class="modal-dialog relative m-10 mx-auto bg-white rounded-lg shadow-lg w-4/5" @click.stop>
      <div class="modal-content relative w-full flex flex-col">
        <!-- Modal Body -->
        <div class="p-11 flex flex-col gap-5">
          <div class="text-title">Add New</div>
          <div class="flex flex-row gap-5">
            <div class="flex-1 flex flex-col">
              <label for="first_name">First Name <span class="text-red-500">*</span></label>
              <InputValidation :has_error="errors && errors.firstname">
                {{ errors.firstname }}
                <template #input :errors="errors.firstname">
                  <Input v-model="data.firstname"
                    class="p-2 block mt-1 w-full error"
                    :class="{ 'custom-invalid': errors && errors.firstname }"
                    id="firstname"
                    type="text" name="firstname" placeholder="Enter first name" autofocus="autofocus" />
                </template>
                <template #errors>
                  <div v-if="errors && errors.firstname">
                    <span v-for="(error, index) in errors.firstname" :key="'firstname-' + index" class="text-red-500 text-xs">{{ error }}</span>
                  </div>
                </template>
              </InputValidation>
            </div>
            <div class="flex-1">
              <label for="last_name">Last Name <span class="text-red-500">*</span></label>
              <InputValidation :has_error="errors && errors.lastname">
                {{ errors.lastname }}
                <template #input :errors="errors.lastname">
                  <Input v-model="data.lastname"
                    class="p-2 block mt-1 w-full error"
                    :class="{ 'custom-invalid': errors && errors.lastname }"
                    id="lastname"
                    type="text" name="lastname" placeholder="Enter last name" />
                </template>
                <template #errors>
                  <div v-if="errors && errors.lastname">
                    <span v-for="(error, index) in errors.lastname" :key="'lastname-' + index" class="text-red-500 text-xs">{{ error }}</span>
                  </div>
                </template>
              </InputValidation>
            </div>
          </div>
          <div class="flex flex-row">
            <div class="flex-1 flex flex-col">
              <label for="email">Email Address <span class="text-red-500">*</span></label>
              <InputValidation :has_error="errors && errors.email">
                {{ errors.email }}
                <template #input :errors="errors.email">
                  <Input v-model="data.email"
                    class="p-2 block mt-1 w-full error"
                    :class="{ 'custom-invalid': errors && errors.email }"
                    id="email"
                    type="email" name="email" placeholder="Enter email address" />
                </template>
                <template #errors>
                  <div v-if="errors && errors.email">
                    <span v-for="(error, index) in errors.email" :key="'email-' + index" class="text-red-500 text-xs">{{ error }}</span>
                  </div>
                </template>
              </InputValidation>
            </div>
          </div>
          <div class="flex flex-row">
            <div class="flex-1 flex flex-col">
              <label for="phone">Phone Number <span class="text-red-500">*</span></label>
              <InputValidation :has_error="errors && errors.phone">
                {{ errors.phone }}
                <template #input :errors="errors.phone">
                  <Input v-model="data.phone"
                    class="p-2 block mt-1 w-full error"
                    :class="{ 'custom-invalid': errors && errors.phone }"
                    id="phone"
                    type="text" name="phone" placeholder="Enter phone number" />
                </template>
                <template #errors>
                  <div v-if="errors && errors.phone">
                    <span v-for="(error, index) in errors.phone" :key="'phone-' + index" class="text-red-500 text-xs">{{ error }}</span>
                  </div>
                </template>
              </InputValidation>
            </div>
          </div>
          <div class="flex flex-row">
            <div class="flex-1 flex flex-col">
              <label for="street">Street Address <span class="text-red-500">*</span></label>
              <InputValidation :has_error="errors && errors.street">
                {{ errors.street }}
                <template #input :errors="errors.street">
                  <Input v-model="data.street"
                    class="p-2 block mt-1 w-full error"
                    :class="{ 'custom-invalid': errors && errors.street }"
                    id="street"
                    type="text" name="street" placeholder="Enter street address" />
                </template>
                <template #errors>
                  <div v-if="errors && errors.street">
                    <span v-for="(error, index) in errors.street" :key="'street-' + index" class="text-red-500 text-xs">{{ error }}</span>
                  </div>
                </template>
              </InputValidation>
            </div>
          </div>
          <div class="flex flex-row gap-5">
            <div class="flex-1 flex flex-col">
              <label for="postal_code">Postal Code <span class="text-red-500">*</span></label>
              <InputValidation :has_error="errors && errors.postal_code">
                {{ errors.postal_code }}
                <template #input :errors="errors.postal_code">
                  <Input v-model="data.postal_code"
                    class="p-2 block mt-1 w-full error"
                    :class="{ 'custom-invalid': errors && errors.postal_code }"
                    id="postal_code"
                    type="text" name="postal_code" placeholder="Enter postal code" />
                </template>
                <template #errors>
                  <div v-if="errors && errors.postal_code">
                    <span v-for="(error, index) in errors.postal_code" :key="'postal_code-' + index" class="text-red-500 text-xs">{{ error }}</span>
                  </div>
                </template>
              </InputValidation>
            </div>
            <div class="flex-1 flex flex-col">
              <label for="country">Country <span class="text-red-500">*</span></label>
              <select v-model="data.country" id="country" :class="{'custom-invalid' : errors && errors.country}" class="p-2 block w-full rounded-xl shadow-sm bg-white border border-gray-300 focus:border-secondary focus:ring focus:ring-secondary focus:ring-opacity-50">
                <option :value="null">Select country</option>
                <option v-for="(country, key) in countries" :value="country.iso2">{{ country.name }}</option>
              </select>
              <div v-if="errors && errors.country">
                <span v-for="(error, index) in errors.country" :key="'country-' + index" class="text-red-500 text-xs">{{ error }}</span>
              </div>
            </div>
            <div class="flex-1 flex flex-col">
              <label for="city">City <span class="text-red-500">*</span></label>
              <select v-model="data.city" id="city" :class="{'custom-invalid' : errors && errors.city}" class="p-2 block w-full rounded-xl shadow-sm bg-white border border-gray-300 focus:border-secondary focus:ring focus:ring-secondary focus:ring-opacity-50">
                <option :value="null">Select city</option>
                <option v-for="(city, key) in cities" :value="city.name">{{ city.name }}</option>
              </select>
              <div v-if="errors && errors.city">
                <span v-for="(error, index) in errors.city" :key="'city-' + index" class="text-red-500 text-xs">{{ error }}</span>
              </div>
            </div>
          </div>
          <div class="flex flex-row">
            <div class="flex-1 flex flex-col">
              <label for="business_type">Business Type <span class="text-red-500">*</span></label>
              <!-- <select v-model="data.business_type" id="business_type" :class="{'custom-invalid' : errors && errors.business_type}" class="p-2 block w-full rounded-xl shadow-sm bg-white border border-gray-300 focus:border-secondary focus:ring focus:ring-secondary focus:ring-opacity-50">
                <option :value="null">Select business type</option>
                <option v-for="(type, key) in businessTypes" :value="type.id">{{ type.name }}</option>
              </select> -->

              <Select v-model="data.business_type" id="business_type" :class="{'custom-invalid' : errors && errors.business_type}" :options="businessTypes" label="Select business type" />
              <div v-if="errors && errors.business_type">
                <span v-for="(error, index) in errors.business_type" :key="'business_type-' + index" class="text-red-500 text-xs">{{ error }}</span>
              </div>
            </div>
          </div>
          <div class="flex flex-row">
            <div class="flex-1 flex flex-col">
              <label for="system_role">System Role <span class="text-red-500">*</span></label>
              <select v-model="data.role" id="system_role" :class="{'custom-invalid' : errors && errors.role}" class="p-2 block w-full rounded-xl shadow-sm bg-white border border-gray-300 focus:border-secondary focus:ring focus:ring-secondary focus:ring-opacity-50">
                <option :value="null">Select system role</option>
                <option v-for="(role, key) in roles" :value="role.id">{{ role.name }}</option>
              </select>
              <div v-if="errors && errors.role">
                <span v-for="(error, index) in errors.role" :key="'role-' + index" class="text-red-500 text-xs">{{ error }}</span>
              </div>
            </div>
          </div>
          <div class="flex flex-row" v-if="enableJobPosition">
            <div class="flex-1 flex flex-col">
              <label for="system_role">Job Position <span class="text-red-500">*</span></label>
              <InputValidation :has_error="errors && errors.job_position">
                {{ errors.job_position }}
                <template #input :errors="errors.job_position">
                  <Input v-model="data.job_position"
                    class="p-2 block mt-1 w-full error"
                    :class="{ 'custom-invalid': errors && errors.job_position }"
                    id="job_position"
                    type="text" name="job_position" placeholder="Enter job position" />
                </template>
                <template #errors>
                  <div v-if="errors && errors.job_position">
                    <span v-for="(error, index) in errors.job_position" :key="'job_position-' + index" class="text-red-500 text-xs">{{ error }}</span>
                  </div>
                </template>
              </InputValidation>
            </div>
          </div>
          <div class="flex flex-row">
            <Button @click="confirmAction()">Add User</Button>
          </div>
        </div>

        <!-- Modal Footer -->
        <!-- <div class="flex items-center justify-end p-4 border-t border-gray-300">
          <button @click="closeModal" class="px-4 py-2 text-gray-500 border border-gray-300 rounded-lg hover:bg-gray-100">
            Cancel
          </button>
          <button @click="confirmAction" class="px-4 py-2 ml-2 text-white bg-blue-500 rounded-lg hover:bg-blue-600">
            Confirm
          </button>
        </div> -->
      </div>
    </div>
  </div>
</template>

<script setup>
import { defineProps, defineEmits, ref, watch, reactive, computed } from "vue";
import Input from "@/components/Input.vue";
import InputValidation from "@/components/InputValidation.vue";
import Select from "@/components/Select.vue";
import Button from "@/components/Button.vue";
import { useBusinessStore } from "@/stores/business";

// Define the prop to control modal visibility
defineProps({
  show: {
    type: Boolean,
    required: true,
  },
});

const businessStore = useBusinessStore();

const countries = ref([]);
const cities = ref([]);
const roles = ref([]);
const businessTypes = ref([]);

const selectedCountry = ref(null);
const selectedCity = ref(null);
const selectedRole = ref(null);
const selectedBusinessType = ref(null);

const data = reactive({
  firstname: null,
  lastname: null,
  email: null,
  phone: null,
  street: null,
  postal_code: null,
  country: null,
  city: null,
  business_type: null,
  role: selectedRole,
  job_position: null,
});
const errors = ref(null);

const enableJobPosition = computed(() => {
  const role = roles.value.find((role) => role.id === selectedRole.value);
  
  return role?.name.toLowerCase() === 'employee';
});
  
// Emit events to notify the parent
const emit = defineEmits(["close"]);

const closeModal = () => {
  emit("close");
};

const confirmAction = () => {
  businessStore.createUser(data).then(() => {
    // closeModal();
  }).catch((error) => {
    errors.value = error.response.data.errors;
  });
};

const getCountries = async () => {
    const cacheKey = 'countries';
    let cachedData = localStorage.getItem(cacheKey);    

    if (cachedData) {
        cachedData = JSON.parse(cachedData);
    } else {
        // If data does not exist in cache, fetch and cache it
        const results = await axios.get('api/v1/address/countries');
        cachedData = results.data.countries;
        localStorage.setItem(cacheKey, JSON.stringify(cachedData));
    }
    
    countries.value = cachedData;
}

getCountries();

const getCities = async (iso2) => {
    const cacheKey = 'cities-' + iso2;
    let cachedData = localStorage.getItem(cacheKey);    

    if (cachedData && false) {
        cachedData = JSON.parse(cachedData);
    } else {
        const results = await axios.get('api/v1/address/cities', {
            params: {
                'iso2': iso2
            }
        })
        cachedData = results.data.cities;
        localStorage.setItem(cacheKey, JSON.stringify(cachedData));
    }
    
    return cachedData;
}

const getRoles = async () => {
    const cacheKey = 'roles';
    let cachedData = localStorage.getItem(cacheKey);    

    if (cachedData && false) {
        cachedData = JSON.parse(cachedData);
    } else {
        // If data does not exist in cache, fetch and cache it
        const results = await axios.get('api/v1/account/roles');
        cachedData = results.data.data;
        localStorage.setItem(cacheKey, JSON.stringify(cachedData));
    }
    
    roles.value = cachedData;
}

getRoles();

const getBusinessTypes = async () => {
    const cacheKey = 'business-types';
    let cachedData = localStorage.getItem(cacheKey);    

    if (cachedData && false) {
        cachedData = JSON.parse(cachedData);
    } else {
        // If data does not exist in cache, fetch and cache it
        const results = await axios.get('api/v1/business/types');
        cachedData = results.data.data;
        localStorage.setItem(cacheKey, JSON.stringify(cachedData));
    }
    
    businessTypes.value = cachedData;
}

getBusinessTypes();

watch(() => data.country, async (newValue, oldValue) => {    
    data.city = null;    
    cities.value = await getCities(newValue);
});
</script>
