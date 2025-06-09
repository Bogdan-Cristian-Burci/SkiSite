@props(['camp', 'userRegistration', 'takenSpots', 'availableSpots'])

@if(auth()->check())
    <!-- Camp Registration Form for Logged In Users -->
    <div class="camp-registration-container">
        @if($userRegistration)
            <!-- Already Registered Section -->
        <div style="display:flex;gap:10px;align-items:center">
            <h4 class="wow fadeIn font-weight-regular">{{__("Your Registration")}}: </h4>
            <small class="text-muted">{{__("Registered on")}} {{ $userRegistration->pivot->created_at->format('M d, Y') }}</small>
            <!-- Cancel icon in corner -->
                <div class="cancel-registration-icon" id="cancel-registration-icon">
                    <i class="mdi mdi-close"></i>
                    <span class="cancel-text">{{__("Cancel Registration")}}</span>
                </div>



        </div>
            <form id="campRegistrationForm" class="rd-form rd-mailform form-lg" method="POST" action="{{ route('camps.updateRegistration', $camp->id) }}">
                @csrf

                <!-- Camp Dates Display -->
                <div class="form-wrap form-wrap-icon wow fadeIn mb-3" data-wow-delay=".05s" style="max-width: 280px;">
                    <input class="form-input form-label-outside"
                           id="camp-dates"
                           type="text"
                           value="{{ $camp->start_date->format('M d, Y') }} - {{ $camp->end_date->format('M d, Y') }}"
                           readonly
                           disabled/>
                    <div class="icon form-icon mdi mdi-calendar"></div>
                </div>

                <!-- Number of Participants -->
                <div class="form-wrap form-wrap-icon wow fadeIn position-relative mb-3" data-wow-delay=".1s" style="max-width: 280px;">
                    <input class="form-input form-label-outside"
                           id="camp-summary"
                           type="text"
                           value="{{ $userRegistration->pivot->number_of_adults }} {{__("Adults")}} - {{ $userRegistration->pivot->number_of_children }} {{__("Children")}}"
                           readonly
                           required/>
                    <div class="icon form-icon mdi mdi-account-multiple"></div>

                    <!-- Custom Dropdown -->
                    <div id="camp-dropdown" class="camp-dropdown" style="display: none;">
                        <div class="camp-dropdown-content">
                            <!-- Adults -->
                            <div class="camp-row">
                                <span class="camp-label">{{__('Adults')}}</span>
                                <div class="camp-controls">
                                    <button type="button" class="camp-btn-decrement" data-target="adults">-</button>
                                    <span id="camp-adults-value" class="camp-value">{{ $userRegistration->pivot->number_of_adults }}</span>
                                    <button type="button" class="camp-btn-increment" data-target="adults">+</button>
                                </div>
                            </div>

                            <!-- Children -->
                            <div class="camp-row">
                                <span class="camp-label">{{__("Children")}}</span>
                                <div class="camp-controls">
                                    <button type="button" class="camp-btn-decrement" data-target="children">-</button>
                                    <span id="camp-children-value" class="camp-value">{{ $userRegistration->pivot->number_of_children }}</span>
                                    <button type="button" class="camp-btn-increment" data-target="children">+</button>
                                </div>
                            </div>

                            <div class="camp-done">
                                <button type="button" id="camp-done-btn" class="button button-sm button-primary">{{__("Done")}}</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Hidden inputs for backend -->
                <input type="hidden" id="camp-adults" name="number_of_adults" value="{{ $userRegistration->pivot->number_of_adults }}" />
                <input type="hidden" id="camp-children" name="number_of_children" value="{{ $userRegistration->pivot->number_of_children }}" />

                <div class="form-element wow fadeIn" data-wow-delay=".3s">
                    <button class="button button-lg button-primary btn-lg" type="submit">{{__("Update Registration")}}</button>
                </div>
            </form>

            <!-- Hidden form for cancellation -->
            <form id="cancelRegistrationForm" method="POST" action="{{ route('camps.cancelRegistration', $camp->id) }}" style="display: none;">
                @csrf
            </form>
        @else
            <!-- New Registration Section -->
            <h4 class="wow fadeIn font-weight-regular">{{__("Register for Camp")}}</h4>

            <form id="campRegistrationForm" class="rd-form rd-mailform form-lg" method="POST" action="{{ route('camps.book', $camp->id) }}">
                @csrf

                <!-- Camp Dates Display -->
                <div class="form-wrap form-wrap-icon wow fadeIn mb-3" data-wow-delay=".05s" style="max-width: 280px;">
                    <input class="form-input form-label-outside"
                           id="camp-dates"
                           type="text"
                           value="{{ $camp->start_date->format('M d, Y') }} - {{ $camp->end_date->format('M d, Y') }}"
                           readonly
                           disabled/>
                    <div class="icon form-icon mdi mdi-calendar"></div>
                </div>

                <!-- Number of Participants -->
                <div class="form-wrap form-wrap-icon wow fadeIn position-relative mb-3" data-wow-delay=".1s" style="max-width: 280px;">
                    <input class="form-input form-label-outside"
                           id="camp-summary"
                           type="text"
                           value="1 {{__("Adults")}} - 0 {{__("Children")}}"
                           readonly
                           required/>
                    <div class="icon form-icon mdi mdi-account-multiple"></div>

                    <!-- Custom Dropdown -->
                    <div id="camp-dropdown" class="camp-dropdown" style="display: none;">
                        <div class="camp-dropdown-content">
                            <!-- Adults -->
                            <div class="camp-row">
                                <span class="camp-label">{{__('Adults')}}</span>
                                <div class="camp-controls">
                                    <button type="button" class="camp-btn-decrement" data-target="adults">-</button>
                                    <span id="camp-adults-value" class="camp-value">1</span>
                                    <button type="button" class="camp-btn-increment" data-target="adults">+</button>
                                </div>
                            </div>

                            <!-- Children -->
                            <div class="camp-row">
                                <span class="camp-label">{{__("Children")}}</span>
                                <div class="camp-controls">
                                    <button type="button" class="camp-btn-decrement" data-target="children">-</button>
                                    <span id="camp-children-value" class="camp-value">0</span>
                                    <button type="button" class="camp-btn-increment" data-target="children">+</button>
                                </div>
                            </div>

                            <div class="camp-done">
                                <button type="button" id="camp-done-btn" class="button button-sm button-primary">{{__("Done")}}</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Hidden inputs for backend -->
                <input type="hidden" id="camp-adults" name="number_of_adults" value="1" />
                <input type="hidden" id="camp-children" name="number_of_children" value="0" />

                <div class="form-element wow fadeIn" data-wow-delay=".3s">
                    <button class="button button-lg button-primary btn-lg" type="submit">{{__("Register for Camp")}}</button>
                </div>
            </form>
        @endif
    </div>
@else
    <!-- Login Button for Non-Authenticated Users -->
    <div class="camp-login-container">
        <h4 class="wow fadeIn font-weight-regular">{{__("Register for Camp")}}</h4>
        <p class="text-gray-500 mb-3">{{__("Please log in to register for this camp")}}.</p>
        <div class="form-element wow fadeIn" data-wow-delay=".1s">
            <a href="{{ route('login') }}" class="button button-lg button-primary btn-lg">
                {{__("Log in to register")}}
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
.camp-dropdown {
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

.camp-dropdown-content {
    padding: 15px;
}

.camp-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 0;
    border-bottom: 1px solid #eee;
}

.camp-row:last-of-type {
    border-bottom: none;
}

.camp-label {
    font-weight: 500;
    color: #333;
}

.camp-controls {
    display: flex;
    align-items: center;
    gap: 10px;
}

.camp-btn-decrement,
.camp-btn-increment {
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

.camp-btn-decrement:hover,
.camp-btn-increment:hover {
    background: #e9ecef;
    border-color: #adb5bd;
}

.camp-value {
    min-width: 20px;
    text-align: center;
    font-weight: 500;
}

.camp-done {
    text-align: center;
    margin-top: 15px;
    padding-top: 15px;
    border-top: 1px solid #eee;
}

.camp-message {
    margin-bottom: 20px;
    padding: 15px;
    border-radius: 4px;
    border: 1px solid;
    animation: slideDown 0.3s ease;
}

.camp-message.alert-success {
    background-color: #d4edda;
    border-color: #c3e6cb;
    color: #155724;
}

.camp-message.alert-danger {
    background-color: #f8d7da;
    border-color: #f5c6cb;
    color: #721c24;
}

.camp-message .alert-content {
    display: flex;
    align-items: flex-start;
    gap: 10px;
}

.camp-message .alert-content i {
    font-size: 18px;
    margin-top: 2px;
    flex-shrink: 0;
}

.bg-success-light {
    background-color: #f8f9fa;
}

.button-outline-danger {
    background: transparent;
    color: #dc3545;
    border-color: #dc3545;
}

.button-outline-danger:hover {
    background: #dc3545;
    color: white;
}

/* Cancel registration icon styles */
.cancel-registration-icon {
    display: flex;
    align-items: center;
    background: rgba(220, 53, 69, 0.1);
    border-radius: 20px;
    padding: 6px 8px;
    cursor: pointer;
    transition: all 0.3s ease;
    overflow: hidden;
    width: 32px;
    z-index: 10;
}

.cancel-registration-icon:hover {
    background: rgba(220, 53, 69);
    width: auto;
    padding: 6px 12px;
    color: #ffffff;

    .cancel-text{
        color: white;
    }
    .mdi-close{
        color: white;
    }
}

.cancel-registration-icon i {
    color: #dc3545;
    font-size: 16px;
    transition: all 0.3s ease;
    min-width: 16px;
}

.cancel-registration-icon .cancel-text {
    color: #dc3545;
    font-size: 12px;
    font-weight: 500;
    margin-left: 6px;
    opacity: 0;
    width: 0;
    transition: all 0.3s ease;
    white-space: nowrap;
    overflow: hidden;
}

.cancel-registration-icon:hover .cancel-text {
    opacity: 1;
    width: auto;
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
    const adultsInput = document.getElementById('camp-adults');
    const childrenInput = document.getElementById('camp-children');
    const form = document.getElementById('campRegistrationForm');
    const cancelForm = document.getElementById('cancelRegistrationForm');

    // Selection dropdown elements
    const summaryInput = document.getElementById('camp-summary');
    const dropdown = document.getElementById('camp-dropdown');
    const doneBtn = document.getElementById('camp-done-btn');
    const adultsValue = document.getElementById('camp-adults-value');
    const childrenValue = document.getElementById('camp-children-value');

    // Values object - initialize with existing values or defaults
    const isExistingRegistration = {{ $userRegistration ? 'true' : 'false' }};
    const values = {
        adults: isExistingRegistration ? {{ $userRegistration->pivot->number_of_adults ?? 1 }} : 1,
        children: isExistingRegistration ? {{ $userRegistration->pivot->number_of_children ?? 0 }} : 0
    };

    // Config limits
    const limits = {
        adults: { min: 0, max: 10 },
        children: { min: 0, max: 10 }
    };

    // Update summary display
    function updateSummary() {
        summaryInput.value = `${values.adults} {{__("Adults")}} - ${values.children} {{__("Children")}}`;
        adultsInput.value = values.adults;
        childrenInput.value = values.children;
    }

    // Update display values
    function updateDisplayValues() {
        adultsValue.textContent = values.adults;
        childrenValue.textContent = values.children;
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
    if (doneBtn) {
        doneBtn.addEventListener('click', function() {
            dropdown.style.display = 'none';
        });
    }

    // Increment/decrement buttons
    document.querySelectorAll('.camp-btn-increment, .camp-btn-decrement').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            const target = this.dataset.target;
            const isIncrement = this.classList.contains('camp-btn-increment');

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

    // Cancel registration icon
    const cancelIcon = document.getElementById('cancel-registration-icon');
    if (cancelIcon) {
        cancelIcon.addEventListener('click', function(e) {
            e.preventDefault();

            if (confirm('{{__("Are you sure you want to cancel your registration for this camp?")}}')) {
                submitCancellation();
            }
        });
    }

    // Form validation and AJAX submission
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault(); // Always prevent default form submission

            const adults = parseInt(adultsInput.value) || 0;
            const children = parseInt(childrenInput.value) || 0;

            // Validation
            if (adults === 0 && children === 0) {
                showMessage('{{__("Please specify at least one adult or child.")}}', 'error');
                return false;
            }

            // Submit via AJAX
            submitCampRegistration();
        });
    }

    // AJAX submission function
    function submitCampRegistration() {
        const submitBtn = form.querySelector('button[type="submit"]');
        const originalText = submitBtn.textContent;

        // Disable button and show loading state
        submitBtn.disabled = true;
        submitBtn.textContent = '{{__("Submitting...")}}';

        // Prepare form data
        const formData = new FormData(form);

        // Make AJAX request
        fetch(form.action, {
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
                // Reload page to show updated registration status
                setTimeout(() => {
                    window.location.reload();
                }, 2000);
            } else {
                showMessage('{{__("An error occurred. Please try again.")}}', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);

            // Handle validation errors
            if (error.errors) {
                let errorMessage = '{{__("Please correct the following errors:")}}';
                Object.keys(error.errors).forEach(key => {
                    errorMessage += `<br>• ${error.errors[key][0]}`;
                });
                showMessage(errorMessage, 'error');
            } else if (error.message) {
                showMessage(error.message, 'error');
            } else {
                showMessage('{{__("An error occurred. Please try again.")}}', 'error');
            }
        })
        .finally(() => {
            // Re-enable button
            submitBtn.disabled = false;
            submitBtn.textContent = originalText;
        });
    }

    // AJAX cancellation function
    function submitCancellation() {
        if (!cancelForm) return;

        // Prepare form data
        const formData = new FormData(cancelForm);

        // Make AJAX request
        fetch(cancelForm.action, {
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
                // Reload page to show updated registration status
                setTimeout(() => {
                    window.location.reload();
                }, 2000);
            } else {
                showMessage('{{__("An error occurred. Please try again.")}}', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showMessage('{{__("An error occurred. Please try again.")}}', 'error');
        });
    }

    // Show message function
    function showMessage(message, type) {
        // Remove existing messages
        const existingMessage = document.querySelector('.camp-message');
        if (existingMessage) {
            existingMessage.remove();
        }

        // Create message element
        const messageEl = document.createElement('div');
        messageEl.className = `camp-message alert ${type === 'success' ? 'alert-success' : 'alert-danger'}`;
        messageEl.innerHTML = `
            <div class="alert-content">
                <i class="mdi ${type === 'success' ? 'mdi-check-circle' : 'mdi-alert-circle'}"></i>
                <span>${message}</span>
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
});
</script>
@endpush
@endif
