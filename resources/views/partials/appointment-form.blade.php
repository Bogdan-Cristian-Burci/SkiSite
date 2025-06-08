@if(auth()->check())
    <!-- Appointment Form for Logged In Users -->
    <div class="appointment-form-container">
        <h4 class="wow fadeIn font-weight-regular">{{__("Make an appointment")}}</h4>

        <form id="appointmentForm" class="rd-form rd-mailform form-lg" method="POST" action="{{ route('appointments.store.fallback') }}">
            @csrf

            <!-- Date Range and Selection Row -->
            <div class="row row-10 text-center">
                <div class="d-inline-block ">
                    <div class="form-wrap form-wrap-icon wow fadeIn" data-wow-delay=".05s">
                        <input class="form-input form-label-outside"
                               id="daterange"
                               type="text"
                               name="date_range"
                               readonly
                               required/>
                        <div class="icon form-icon mdi mdi-calendar"></div>
                    </div>
                </div>

                <div class="d-inline-block ">
                    <div class="form-wrap form-wrap-icon wow fadeIn position-relative" data-wow-delay=".1s">
                        <input class="form-input form-label-outside"
                               id="appointment-summary"
                               type="text"
                               value="1 .{{__("Adults")}}. - 0 .{{__("Children")}}. - 1 .{{__("Hours")}}"
                               readonly
                               required/>
                        <div class="icon form-icon mdi mdi-account-multiple"></div>

                        <!-- Custom Dropdown -->
                        <div id="appointment-dropdown" class="appointment-dropdown" style="display: none;">
                            <div class="appointment-dropdown-content">
                                <!-- Adults -->
                                <div class="appointment-row">
                                    <span class="appointment-label">{{__('Adults')}}</span>
                                    <div class="appointment-controls">
                                        <button type="button" class="appointment-btn-decrement" data-target="adults">-</button>
                                        <span id="adults-value" class="appointment-value">1</span>
                                        <button type="button" class="appointment-btn-increment" data-target="adults">+</button>
                                    </div>
                                </div>

                                <!-- Children -->
                                <div class="appointment-row">
                                    <span class="appointment-label">{{__("Children")}}</span>
                                    <div class="appointment-controls">
                                        <button type="button" class="appointment-btn-decrement" data-target="children">-</button>
                                        <span id="children-value" class="appointment-value">0</span>
                                        <button type="button" class="appointment-btn-increment" data-target="children">+</button>
                                    </div>
                                </div>

                                <!-- Hours -->
                                <div class="appointment-row">
                                    <span class="appointment-label">{{__("Hours")}}/{{__("Day")}}</span>
                                    <div class="appointment-controls">
                                        <button type="button" class="appointment-btn-decrement" data-target="hours">-</button>
                                        <span id="hours-value" class="appointment-value">1</span>
                                        <button type="button" class="appointment-btn-increment" data-target="hours">+</button>
                                    </div>
                                </div>

                                <div class="appointment-done">
                                    <button type="button" id="appointment-done-btn" class="button button-sm button-primary">{{__("Done")}}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hidden inputs for backend -->
            <input type="hidden" id="start_date" name="start_date" />
            <input type="hidden" id="end_date" name="end_date" />
            <input type="hidden" id="appointment-adults" name="number_of_adults" value="1" />
            <input type="hidden" id="appointment-children" name="number_of_children" value="0" />
            <input type="hidden" id="appointment-hours" name="hours_per_day" value="1" />

            <div class="form-element wow fadeIn" data-wow-delay=".3s">
                <button class="button button-lg button-primary btn-lg" type="submit">{{__("Book Appointment")}}</button>
            </div>
        </form>
    </div>
@else
    <!-- Login Button for Non-Authenticated Users -->
    <div class="appointment-login-container">
        <h4 class="wow fadeIn font-weight-regular">{{__("Make an appointment")}}</h4>
        <p class="text-gray-500 mb-3">{{__("Please log in to book an appointment with our ski instructors")}}.</p>
        <div class="form-element wow fadeIn" data-wow-delay=".1s">
            <a href="{{ route('login') }}" class="button button-lg button-primary btn-lg">
                {{__("Log in to make an appointment")}}
            </a>
        </div>
        <div class="mt-3 text-center wow fadeIn" data-wow-delay=".15s">
            <p class="text-sm text-gray-500">
                {{__("Don't have an account?")}}
                <a href="{{ route('register') }}" class="text-primary">{{__("Sign up here")}}</a>
            </p>
        </div>
    </div>
@endif

@if(auth()->check())
@push('styles')
<style>
.appointment-dropdown {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background: white;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    z-index: 1000;
    margin-top: 2px;
}

.appointment-dropdown-content {
    padding: 15px;
}

.appointment-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 0;
    border-bottom: 1px solid #eee;
}

.appointment-row:last-of-type {
    border-bottom: none;
}

.appointment-label {
    font-weight: 500;
    color: #333;
}

.appointment-controls {
    display: flex;
    align-items: center;
    gap: 10px;
}

.appointment-btn-decrement,
.appointment-btn-increment {
    width: 30px;
    height: 30px;
    border: 1px solid #ddd;
    background: #f8f9fa;
    border-radius: 4px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    font-weight: bold;
    color: #666;
    transition: all 0.2s;
}

.appointment-btn-decrement:hover,
.appointment-btn-increment:hover {
    background: #e9ecef;
    border-color: #adb5bd;
}

.appointment-value {
    min-width: 20px;
    text-align: center;
    font-weight: 500;
}

.appointment-done {
    text-align: center;
    margin-top: 15px;
    padding-top: 15px;
    border-top: 1px solid #eee;
}

.appointment-message {
    margin-bottom: 20px;
    padding: 15px;
    border-radius: 4px;
    border: 1px solid;
    animation: slideDown 0.3s ease;
}

.appointment-message.alert-success {
    background-color: #d4edda;
    border-color: #c3e6cb;
    color: #155724;
}

.appointment-message.alert-danger {
    background-color: #f8d7da;
    border-color: #f5c6cb;
    color: #721c24;
}

.appointment-message .alert-content {
    display: flex;
    align-items: flex-start;
    gap: 10px;
}

.appointment-message .alert-content i {
    font-size: 18px;
    margin-top: 2px;
    flex-shrink: 0;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const adultsInput = document.getElementById('appointment-adults');
    const childrenInput = document.getElementById('appointment-children');
    const hoursInput = document.getElementById('appointment-hours');
    const form = document.getElementById('appointmentForm');
    const startDateHidden = document.getElementById('start_date');
    const endDateHidden = document.getElementById('end_date');

    // Selection dropdown elements
    const summaryInput = document.getElementById('appointment-summary');
    const dropdown = document.getElementById('appointment-dropdown');
    const doneBtn = document.getElementById('appointment-done-btn');
    const adultsValue = document.getElementById('adults-value');
    const childrenValue = document.getElementById('children-value');
    const hoursValue = document.getElementById('hours-value');

    // Values object
    const values = {
        adults: 1,
        children: 0,
        hours: 1
    };

    // Config limits
    const limits = {
        adults: { min: 0, max: {{ config('appointment.limits.max_adults', 10) }} },
        children: { min: 0, max: {{ config('appointment.limits.max_children', 10) }} },
        hours: { min: 1, max: {{ config('appointment.limits.max_hours_per_day', 8) }} }
    };

    // Update summary display
    function updateSummary() {
        summaryInput.value = `${values.adults} adults - ${values.children} children - ${values.hours} hours`;
        adultsInput.value = values.adults;
        childrenInput.value = values.children;
        hoursInput.value = values.hours;
    }

    // Update display values
    function updateDisplayValues() {
        adultsValue.textContent = values.adults;
        childrenValue.textContent = values.children;
        hoursValue.textContent = values.hours;
    }

    // Show/hide dropdown
    summaryInput.addEventListener('click', function(e) {
        e.stopPropagation();
        dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function(e) {
        if (!dropdown.contains(e.target) && e.target !== summaryInput) {
            dropdown.style.display = 'none';
        }
    });

    // Done button
    doneBtn.addEventListener('click', function() {
        dropdown.style.display = 'none';
    });

    // Increment/decrement buttons
    document.querySelectorAll('.appointment-btn-increment, .appointment-btn-decrement').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            const target = this.dataset.target;
            const isIncrement = this.classList.contains('appointment-btn-increment');

            if (isIncrement) {
                if (values[target] < limits[target].max) {
                    values[target]++;
                }
            } else {
                if (values[target] > limits[target].min) {
                    values[target]--;
                }
            }

            updateDisplayValues();
            updateSummary();
        });
    });

    // Initialize display
    updateDisplayValues();
    updateSummary();

    // Initialize daterangepicker
    $('#daterange').daterangepicker({
        "autoApply": true,
        "startDate": moment().format('MM/DD/YYYY'),
        "endDate": moment().add(6, 'days').format('MM/DD/YYYY'),
        "minDate": moment().format('MM/DD/YYYY'),
        "maxDate": moment().add(365, 'days').format('MM/DD/YYYY')
    }, function(start, end, label) {
        console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');

        // Update hidden inputs for backend
        startDateHidden.value = start.format('YYYY-MM-DD');
        endDateHidden.value = end.format('YYYY-MM-DD');
    });

    // Set initial values for hidden inputs
    startDateHidden.value = moment().format('YYYY-MM-DD');
    endDateHidden.value = moment().add(6, 'days').format('YYYY-MM-DD');

    // Form validation and AJAX submission
    form.addEventListener('submit', function(e) {
        e.preventDefault(); // Always prevent default form submission

        const adults = parseInt(adultsInput.value) || 0;
        const children = parseInt(childrenInput.value) || 0;
        const hours = parseInt(hoursInput.value) || 0;

        // Validation
        if (adults === 0 && children === 0) {
            showMessage('Please specify at least one adult or child.', 'error');
            return false;
        }

        if (hours === 0) {
            showMessage('Please specify hours per day.', 'error');
            return false;
        }

        // Ensure dates are set
        if (!startDateHidden.value || !endDateHidden.value) {
            showMessage('Please select a date range.', 'error');
            return false;
        }

        // Submit via AJAX
        submitAppointment();
    });

    // AJAX submission function
    function submitAppointment() {
        const submitBtn = form.querySelector('button[type="submit"]');
        const originalText = submitBtn.textContent;

        // Disable button and show loading state
        submitBtn.disabled = true;
        submitBtn.textContent = 'Submitting...';

        // Prepare form data
        const formData = new FormData(form);

        // Make AJAX request
        fetch('{{ route("appointments.store.fallback") }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(data => Promise.reject(data));
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                showMessage(data.message, 'success');
                resetForm();
            } else {
                showMessage('An error occurred. Please try again.', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);

            // Handle validation errors
            if (error.errors) {
                let errorMessage = 'Please correct the following errors:\n';
                Object.keys(error.errors).forEach(key => {
                    errorMessage += `• ${error.errors[key][0]}\n`;
                });
                showMessage(errorMessage, 'error');
            } else if (error.message) {
                showMessage(error.message, 'error');
            } else {
                showMessage('An error occurred. Please try again.', 'error');
            }
        })
        .finally(() => {
            // Re-enable button
            submitBtn.disabled = false;
            submitBtn.textContent = originalText;
        });
    }

    // Show message function
    function showMessage(message, type) {
        // Remove existing messages
        const existingMessage = document.querySelector('.appointment-message');
        if (existingMessage) {
            existingMessage.remove();
        }

        // Create message element
        const messageEl = document.createElement('div');
        messageEl.className = `appointment-message alert ${type === 'success' ? 'alert-success' : 'alert-danger'}`;
        messageEl.innerHTML = `
            <div class="alert-content">
                <i class="mdi ${type === 'success' ? 'mdi-check-circle' : 'mdi-alert-circle'}"></i>
                <span>${message.replace(/\n/g, '<br>')}</span>
            </div>
        `;

        // Insert message before form
        form.parentNode.insertBefore(messageEl, form);

        // Auto-hide success messages after 5 seconds
        if (type === 'success') {
            setTimeout(() => {
                messageEl.remove();
            }, 5000);
        }

        // Scroll to message
        messageEl.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }

    // Reset form function
    function resetForm() {
        // Reset to default values
        values.adults = 1;
        values.children = 0;
        values.hours = 1;

        // Update displays
        updateDisplayValues();
        updateSummary();

        // Reset date range to default
        $('#daterange').data('daterangepicker').setStartDate(moment());
        $('#daterange').data('daterangepicker').setEndDate(moment().add(6, 'days'));
        startDateHidden.value = moment().format('YYYY-MM-DD');
        endDateHidden.value = moment().add(6, 'days').format('YYYY-MM-DD');
    }
});
</script>
@endpush
@endif
