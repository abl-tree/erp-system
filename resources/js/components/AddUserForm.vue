<template>
  <div v-if="show" class="block fixed inset-0 w-full h-full overflow-x-hidden overflow-y-auto z-50 bg-black bg-opacity-50" @click="closeModal">
    <div class="modal-dialog relative m-10 mx-auto bg-white rounded-lg shadow-lg w-4/5" @click.stop>
      <div class="modal-content relative w-full flex flex-col">
        <!-- Modal Body -->
        <div class="p-11 flex flex-col gap-5">
          <div class="text-title !text-primary">{{ computedAction ?? "Add New" }} </div>
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
          <div class="flex flex-row gap-5">
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
            <div v-if="subRoles.length" class="flex-1 flex flex-col">
              <label for="system_sub_role">Sub Role <span class="text-red-500">*</span></label>
              <select v-model="data.sub_role" id="system_sub_role" :class="{'custom-invalid' : errors && errors.role}" class="p-2 block w-full rounded-xl shadow-sm bg-white border border-gray-300 focus:border-secondary focus:ring focus:ring-secondary focus:ring-opacity-50">
                <option :value="null">Select system sub role</option>
                <option v-for="(role, key) in subRoles" :value="role.id">{{ role.name }}</option>
              </select>
              <div v-if="errors && errors.role">
                <span v-for="(error, index) in errors.role" :key="'role-' + index" class="text-red-500 text-xs">{{ error }}</span>
              </div>
            </div>
          </div>
          <template v-if="enableJobPosition">
          <div class="flex flex-row">
            <div class="flex-1 flex flex-col">
              <label for="job_position">Job Position <span class="text-red-500">*</span></label>
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
            <div class="flex-1 flex flex-col">
              <label for="department">Department <span class="text-red-500">*</span></label>
              <select v-model="data.department" id="department" :class="{'custom-invalid' : errors && errors.department}" class="p-2 block w-full rounded-xl shadow-sm bg-white border border-gray-300 focus:border-secondary focus:ring focus:ring-secondary focus:ring-opacity-50">
                <option :value="null">Select department</option>
                <option v-for="(value, key) in departments" :value="value.id">{{ value.name }}</option>
              </select>
              <div v-if="errors && errors.department">
                <span v-for="(error, index) in errors.department" :key="'department-' + index" class="text-red-500 text-xs">{{ error }}</span>
              </div>
            </div>
          </div>
          <div class="flex flex-row">
            <div class="flex-1 flex flex-col">
              <label for="employment_type">Employment Type <span class="text-red-500">*</span></label>
              <select v-model="data.employment_type" id="employment_type" :class="{'custom-invalid' : errors && errors.employment_type}" class="p-2 block w-full rounded-xl shadow-sm bg-white border border-gray-300 focus:border-secondary focus:ring focus:ring-secondary focus:ring-opacity-50">
                <option :value="null">Select employment type</option>
                <option v-for="(value, key) in employmentTypes" :value="value.id">{{ value.name }}</option>
              </select>
              <div v-if="errors && errors.employment_type">
                <span v-for="(error, index) in errors.employment_type" :key="'employment_type-' + index" class="text-red-500 text-xs">{{ error }}</span>
              </div>
            </div>
          </div>
          <div class="grid grid-cols-2 grid-rows-2 gap-5">
            <div class="row-span-2 flex flex-col">
              <label for="special_notes">Special Notes</label>
              <InputValidation class="grow" :has_error="errors && errors.special_notes">
                {{ errors.special_notes }}
                <template #input :errors="errors.special_notes">
                  <Textarea v-model="data.special_notes"
                    class="p-2 block mt-1 w-full error h-full"
                    :class="{ 'custom-invalid': errors && errors.special_notes }"
                    id="special_notes"
                    type="text" name="special_notes" placeholder="Enter special notes" />
                </template>
                <template #errors>
                  <div v-if="errors && errors.special_notes">
                    <span v-for="(error, index) in errors.special_notes" :key="'special_notes-' + index" class="text-red-500 text-xs">{{ error }}</span>
                  </div>
                </template>
              </InputValidation>
            </div>
            <div class="flex flex-col">
              <label for="start_date">Start Date <span class="text-red-500">*</span></label>
              <VueTailwindDatepicker 
                class="rounded-xl focus:border-secondary focus:ring focus:ring-secondary focus:ring-opacity-50"
                v-model="data.start_date" 
                as-single
                :formatter="{
                  date: 'YYYY-MM-DD',
                  month: 'MMM',
                }" />
            </div>
            <div class="flex flex-col">
              <label for="attendance_shift">Attendance Shift <span class="text-red-500">*</span></label>
              <select v-model="data.attendance_shift" id="attendance_shift" :class="{'custom-invalid' : errors && errors.attendance_shift}" class="p-2 block w-full rounded-xl shadow-sm bg-white border border-gray-300 focus:border-secondary focus:ring focus:ring-secondary focus:ring-opacity-50">
                <option :value="null">Select attendance shift</option>
                <option v-for="(value, key) in attendanceShifts" :value="value.id">{{ value.name }}</option>
              </select>
              <div v-if="errors && errors.attendance_shift">
                <span v-for="(error, index) in errors.attendance_shift" :key="'attendance_shift-' + index" class="text-red-500 text-xs">{{ error }}</span>
              </div>
            </div>
          </div>
          </template>
          <div class="flex flex-row">
            <Button v-if="!userManagementStore.action || userManagementStore.action == 'Edit'" @click="confirmAction()">{{ userManagementStore.action ?? 'Add'  }} User</Button>
          </div>
        </div>
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
import Textarea from "@/components/Textarea.vue";
import VueTailwindDatepicker from 'vue-tailwind-datepicker';
import { useAccountStore } from "@/stores/account";
import { useUserManagementStore } from "@/stores/user-management";

// Define the prop to control modal visibility
defineProps({
  show: {
    type: Boolean,
    required: true,
  },
});

const businessStore = useBusinessStore();
const accountStore = useAccountStore();
const userManagementStore = useUserManagementStore();

const countries = ref([]);
const cities = ref([]);
const roles = ref([]);
const subRoles = ref([]);
const businessTypes = ref([]);
const departments = ref([]);
const employmentTypes = ref([]);
const attendanceShifts = ref([]);

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
    role: null,
    sub_role: null,
    job_position: null,
    department: null,
    employment_type: null,
    special_notes: null,
    start_date: '',
    attendance_shift: null
  });
const errors = ref(null);

const enableJobPosition = computed(() => {
  const role = roles.value.find((role) => role.id === data.role);
  
  return role?.name.toLowerCase() === 'employee';
});
  
// Emit events to notify the parent
const emit = defineEmits(["close"]);

const closeModal = () => {
  emit("close");
};

const confirmAction = () => {
  if (userManagementStore.action == 'Edit') {
    updateUser();
  } else {
    createUser();
  }
};

const createUser = () => {
  businessStore.createUser(data).then((res) => {
    let user = res.data.data;

    userManagementStore.insertUser(user);
    closeModal();
  }).catch((error) => {
    errors.value = error.response.data.errors;
  });
};

const updateUser = () => {
  businessStore.updateUser(data).then(() => {
    closeModal();
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
    if (accountStore.roles.length == 0) {
      accountStore.getRoles().then((res) => {
          roles.value = res.data.data;
      });
    } else {
        roles.value = accountStore.roles;
    }
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

const getDepartments = async () => {
    const cacheKey = 'business-types';
    let cachedData = localStorage.getItem(cacheKey);    

    if (cachedData && false) {
        cachedData = JSON.parse(cachedData);
    } else {
        // If data does not exist in cache, fetch and cache it
        const results = await axios.get('api/v1/department');
        
        cachedData = results.data.data;
        localStorage.setItem(cacheKey, JSON.stringify(cachedData));
    }
    
    departments.value = cachedData;
}

getDepartments();

const getEmploymentTypes = async () => {
    const cacheKey = 'employment-types';
    let cachedData = localStorage.getItem(cacheKey);    

    if (cachedData && false) {
        cachedData = JSON.parse(cachedData);
    } else {
        // If data does not exist in cache, fetch and cache it
        const results = await axios.get('api/v1/employment/types');
        
        cachedData = results.data.data;
        localStorage.setItem(cacheKey, JSON.stringify(cachedData));
    }
    
    employmentTypes.value = cachedData;
}

getEmploymentTypes();

const getAttendanceShifts = async () => {
    const cacheKey = 'attendance-shifts';
    let cachedData = localStorage.getItem(cacheKey);    

    if (cachedData && false) {
        cachedData = JSON.parse(cachedData);
    } else {
        // If data does not exist in cache, fetch and cache it
        const results = await axios.get('api/v1/employment/shifts');
        
        cachedData = results.data.data;
        localStorage.setItem(cacheKey, JSON.stringify(cachedData));
    }
    
    attendanceShifts.value = cachedData;
}

getAttendanceShifts();

const computedAction = computed(() => {
  if (userManagementStore.action && userManagementStore.user?.id) return userManagementStore.action + " - #" + userManagementStore.user.id;
  else return null;
});

watch(() => data.country, async (newValue, oldValue) => {    
    data.city = null;    
    cities.value = await getCities(newValue);

    if (userManagementStore.user?.city) {
        data.city = userManagementStore.user.city;
    }
});

watch(() => data.role, async (newValue, oldValue) => {
  data.sub_role = null;

  subRoles.value = []

  accountStore.getSubRoles(newValue).then((res) => {
    subRoles.value = res.data.data;    
  });
});

watch(() => userManagementStore.user, async (newValue, oldValue) => {  
  Object.assign(data, newValue);
});
</script>
