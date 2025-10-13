<?php

namespace App\Livewire\Pages;

use App\Models\AboutUs;
use App\Models\Contact;
use App\Models\TeamMember;
use Livewire\Component;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class About extends Component
{
    // Dynamic content from Voyager backend
    public $aboutUs;
    public $teamMembers;
    public $statistics;

    // Contact form properties
    public $name = '';
    public $email = '';
    public $phone = '';
    public $interest = 'Serengeti National Park tour';
    public $persons = 1;

    // Success and error states
    public $showSuccess = false;
    public $showError = false;
    public $errorMessage = '';
    public $isSubmitting = false;

    protected $rules = [
        'name' => 'required|min:2|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'nullable|string|max:20',
        'interest' => 'nullable|string|max:255',
        'persons' => 'required|integer|min:1|max:50'
    ];

    protected $messages = [
        'name.required' => 'Please enter your full name.',
        'name.min' => 'Your name must be at least 2 characters.',
        'name.max' => 'Name is too long. Please keep it under 255 characters.',
        'email.required' => 'Please enter your email address.',
        'email.email' => 'Please enter a valid email address.',
        'email.max' => 'Email address is too long.',
        'phone.max' => 'Phone number should not exceed 20 characters.',
        'interest.max' => 'Tour interest description is too long.',
        'persons.required' => 'Please specify number of persons.',
        'persons.integer' => 'Number of persons must be a valid number.',
        'persons.min' => 'Number of persons must be at least 1.',
        'persons.max' => 'Maximum 50 persons allowed per booking.'
    ];

    public function mount()
    {
        try {
            // Load About Us content from Voyager backend
            $this->loadAboutUsContent();

            // Load team members from Voyager backend
            $this->loadTeamMembers();

            // Load statistics dynamically from backend
            $this->loadStatistics();

            Log::info('About page loaded successfully', [
                'has_about_us' => $this->aboutUs ? true : false,
                'team_members_count' => $this->teamMembers ? $this->teamMembers->count() : 0,
            ]);

        } catch (\Exception $e) {
            Log::error('Error loading About page data from backend', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            // Set safe defaults if backend fails
            $this->setDefaultContent();
        }
    }

    /**
     * Load About Us content from Voyager backend
     */
    protected function loadAboutUsContent()
    {
        // Get active About Us content from Voyager backend
        $this->aboutUs = AboutUs::active()
            ->ordered()
            ->first();

        // If no content found in backend, create default object with all properties
        if (!$this->aboutUs) {
            Log::warning('No About Us content found in Voyager backend, using defaults');

            $this->aboutUs = (object) [
                'title' => 'Making it real',
                'subtitle' => 'We are the leading tours and safari company giving you an exceptionally new experience',
                'description' => 'Rorena Tours and Safaris was established to increase the number of people interested in visiting Uganda. Since then, we have expanded our Itinerary to include Uganda, Rwanda, Democratic Republic of Congo (D.R.C), Tanzania and Kenya.',
                'mission' => 'Rorena Tours and Safaris is a small-medium sized equipped, experienced, locally owned tours and safari company based in Kampala, Uganda. We offer quality, exceptional, affordable budget, deluxe and luxury or highland tours to Uganda and the entire of East African countries with a personal touch.',
                'vision' => 'To be the leading sustainable tourism company in East Africa, creating unforgettable memories while preserving our natural heritage.',
                'values' => [],
                'main_image' => 'images/waterfall.jpg',
                'main_image_url' => asset('images/waterfall.jpg'),
                'gallery_images' => [],
                'gallery_images_urls' => [],
                'years_experience' => 10,
                'happy_clients' => 1315,
                'tours_completed' => 768,
                'destinations' => 25,
                'phone' => '+256-800500000',
                'email' => 'info@rorenatours.com',
                'address' => 'Kikumbi, Wakiso Uganda',
                'latitude' => null,
                'longitude' => null,
                'social_media' => [],
                'stats' => [
                    'years_experience' => 10,
                    'happy_clients' => 1315,
                    'tours_completed' => 768,
                    'destinations' => 25,
                ],
                'company_values' => [],
                'contact_info' => [
                    'phone' => '+256-800500000',
                    'email' => 'info@rorenatours.com',
                    'address' => 'Kikumbi, Wakiso Uganda',
                ],
                'social_media_links' => [
                    'facebook' => 'https://facebook.com/rorenatours',
                    'twitter' => 'https://twitter.com/rorenatours',
                    'instagram' => 'https://instagram.com/rorenatours',
                    'linkedin' => '',
                    'youtube' => 'https://youtube.com/rorenatours',
                    'whatsapp' => '',
                ],
            ];
        } else {
            Log::info('Loaded About Us content from Voyager backend', [
                'id' => $this->aboutUs->id,
                'title' => $this->aboutUs->title
            ]);
        }
    }

    /**
     * Load team members from Voyager backend
     */
    protected function loadTeamMembers()
    {
        // Check if TeamMember model exists and load from backend
        if (class_exists(TeamMember::class)) {
            $this->teamMembers = TeamMember::where('is_active', true)
                ->orWhere('status', 'active')
                ->orderBy('sort_order', 'asc')
                ->orderBy('created_at', 'asc')
                ->get();

            Log::info('Loaded team members from Voyager backend', [
                'count' => $this->teamMembers->count()
            ]);
        }

        // If no team members found in backend, use defaults
        if (!$this->teamMembers || $this->teamMembers->isEmpty()) {
            Log::warning('No team members found in Voyager backend, using defaults');

            $this->teamMembers = collect([
                (object) [
                    'name' => 'John Opio',
                    'position' => 'CEO',
                    'image' => 'https://api.dicebear.com/7.x/personas/svg?seed=JohnOpio&backgroundColor=22c55e'
                ],
                (object) [
                    'name' => 'Jessica Among',
                    'position' => 'Tour Expert',
                    'image' => 'https://api.dicebear.com/7.x/personas/svg?seed=JessicaAmong&backgroundColor=34d399'
                ],
                (object) [
                    'name' => 'Douglas Atuhaire',
                    'position' => 'Tour Guide',
                    'image' => 'https://api.dicebear.com/7.x/personas/svg?seed=DouglasAtuhaire&backgroundColor=4ade80'
                ],
                (object) [
                    'name' => 'Hassan Cheptegei',
                    'position' => 'Head of Transport',
                    'image' => 'https://api.dicebear.com/7.x/personas/svg?seed=HassanCheptegei&backgroundColor=16a34a'
                ],
                (object) [
                    'name' => 'Jane Nankabirwa',
                    'position' => 'Customer Support',
                    'image' => 'https://api.dicebear.com/7.x/personas/svg?seed=JaneNankabirwa&backgroundColor=15803d'
                ],
            ]);
        }
    }

    /**
     * Load statistics dynamically from backend data
     */
    protected function loadStatistics()
    {
        try {
            // If aboutUs exists, use its stats
            if ($this->aboutUs && is_object($this->aboutUs) && isset($this->aboutUs->stats)) {
                $this->statistics = $this->aboutUs->stats;

                Log::info('Loaded statistics from About Us record', [
                    'stats' => $this->statistics
                ]);
                return;
            }

            // Otherwise, use direct properties
            if ($this->aboutUs && is_object($this->aboutUs)) {
                $this->statistics = [
                    'tours_completed' => $this->aboutUs->tours_completed ?? 768,
                    'happy_customers' => $this->aboutUs->happy_clients ?? 1315,
                ];

                Log::info('Loaded statistics from About Us properties', [
                    'stats' => $this->statistics
                ]);
                return;
            }

            // Fallback to defaults
            $this->statistics = [
                'tours_completed' => 768,
                'happy_customers' => 1315,
            ];

        } catch (\Exception $e) {
            Log::warning('Could not load statistics from backend', [
                'error' => $e->getMessage()
            ]);

            // Use default statistics
            $this->statistics = [
                'tours_completed' => 768,
                'happy_customers' => 1315,
            ];
        }
    }

    /**
     * Set default content if backend fails
     */
    protected function setDefaultContent()
    {
        $this->aboutUs = (object) [
            'title' => 'Making it real',
            'subtitle' => 'We are the leading tours and safari company',
            'description' => 'Discover East Africa with Rorena Tours and Safaris',
            'mission' => 'Rorena Tours and Safaris is a small-medium sized equipped, experienced, locally owned tours and safari company based in Kampala, Uganda.',
            'vision' => 'To be the leading sustainable tourism company in East Africa.',
            'main_image' => 'images/waterfall.jpg',
            'main_image_url' => asset('images/waterfall.jpg'),
            'gallery_images' => [],
            'gallery_images_urls' => [],
            'years_experience' => 10,
            'happy_clients' => 1315,
            'tours_completed' => 768,
            'destinations' => 25,
            'phone' => '+256-800500000',
            'email' => 'info@rorenatours.com',
            'address' => 'Kikumbi, Wakiso Uganda',
            'stats' => [
                'years_experience' => 10,
                'happy_clients' => 1315,
                'tours_completed' => 768,
                'destinations' => 25,
            ],
        ];

        $this->teamMembers = collect([]);

        $this->statistics = [
            'tours_completed' => 768,
            'happy_customers' => 1315,
        ];
    }

    /**
     * Helper method to get main image URL safely
     */
    public function getMainImageUrl()
    {
        if (!$this->aboutUs) {
            return asset('images/waterfall.jpg');
        }

        // If it's the actual model with accessor
        if (is_object($this->aboutUs) && method_exists($this->aboutUs, 'getMainImageUrlAttribute')) {
            return $this->aboutUs->main_image_url;
        }

        // If it's our fallback stdClass with main_image_url
        if (isset($this->aboutUs->main_image_url)) {
            return $this->aboutUs->main_image_url;
        }

        // If it has main_image property
        if (isset($this->aboutUs->main_image)) {
            if (str_starts_with($this->aboutUs->main_image, 'http')) {
                return $this->aboutUs->main_image;
            }
            return asset('storage/' . $this->aboutUs->main_image);
        }

        return asset('images/waterfall.jpg');
    }

    /**
     * Real-time validation
     */
    public function updated($propertyName)
    {
        // Skip validation for non-form fields
        if (in_array($propertyName, ['showSuccess', 'showError', 'errorMessage', 'isSubmitting'])) {
            return;
        }

        try {
            $this->validateOnly($propertyName);

            // Clear error message when field becomes valid
            if ($this->showError && empty($this->getErrorBag()->get($propertyName))) {
                $this->showError = false;
                $this->errorMessage = '';
            }
        } catch (ValidationException $e) {
            // Validation errors are automatically displayed
        }
    }

    /**
     * Submit contact form - Push to Voyager backend
     */
    public function submitContact()
    {
        // Prevent double submission
        if ($this->isSubmitting) {
            return;
        }

        $this->isSubmitting = true;
        $this->showSuccess = false;
        $this->showError = false;
        $this->errorMessage = '';

        try {
            // Validate all fields
            $validated = $this->validate();

            // Additional security checks
            $this->performSecurityChecks();

            // Start database transaction
            DB::beginTransaction();

            try {
                // Push to Voyager backend - Contact model
                $contact = Contact::create([
                    'name' => trim($this->name),
                    'email' => trim(strtolower($this->email)),
                    'phone' => $this->phone ? trim($this->phone) : null,
                    'subject' => 'Tour Inquiry: ' . $this->interest,
                    'message' => "Interested in: {$this->interest}\nNumber of travelers: {$this->persons}",
                    'inquiry_type' => 'tour',
                    'preferred_contact_method' => $this->phone ? 'phone' : 'email',
                    'number_of_travelers' => $this->persons,
                    'country' => 'Uganda',
                    'status' => 'new',
                    'ip_address' => request()->ip(),
                    'user_agent' => request()->userAgent(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // Commit transaction - data pushed to backend
                DB::commit();

                // Log successful submission to backend
                Log::info('Contact form submitted and pushed to Voyager backend', [
                    'contact_id' => $contact->id,
                    'email' => $this->email,
                    'inquiry_type' => 'tour',
                    'travelers' => $this->persons,
                    'ip' => request()->ip(),
                    'backend' => 'voyager',
                    'table' => 'contacts',
                ]);

                // Show success message
                $this->showSuccess = true;

                // Reset form fields
                $this->reset(['name', 'email', 'phone', 'persons']);
                $this->interest = 'Serengeti National Park tour';

                // Auto-hide success message after 8 seconds
                $this->dispatch('contact-submitted');
                $this->js("setTimeout(() => { \$wire.set('showSuccess', false) }, 8000)");

                // Dispatch event for other components
                $this->dispatch('contact-form-submitted', [
                    'contactId' => $contact->id,
                    'backend' => 'voyager'
                ]);

            } catch (\Exception $e) {
                // Rollback transaction on error
                DB::rollBack();
                throw $e;
            }

        } catch (ValidationException $e) {
            Log::warning('Contact form validation failed', [
                'errors' => $e->errors(),
                'email' => $this->email,
                'ip' => request()->ip(),
            ]);

            $this->showError = true;
            $this->errorMessage = 'Please correct the errors in the form and try again.';

        } catch (\Illuminate\Database\QueryException $e) {
            Log::error('Database error pushing to backend', [
                'error' => $e->getMessage(),
                'code' => $e->getCode(),
                'email' => $this->email,
                'ip' => request()->ip(),
                'backend' => 'voyager',
            ]);

            $this->showError = true;
            $this->errorMessage = 'We\'re experiencing technical difficulties. Please try again in a few moments.';

        } catch (\Exception $e) {
            Log::error('Unexpected error submitting to backend', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'email' => $this->email,
                'ip' => request()->ip(),
            ]);

            $this->showError = true;
            $this->errorMessage = 'Something went wrong. Please try again or contact us at info@rorenatours.com';

        } finally {
            $this->isSubmitting = false;
        }
    }

    /**
     * Perform security checks
     */
    protected function performSecurityChecks()
    {
        // Rate limiting check - prevent spam
        $recentSubmissions = Contact::where('ip_address', request()->ip())
            ->where('created_at', '>', now()->subMinutes(5))
            ->count();

        if ($recentSubmissions >= 3) {
            Log::warning('Rate limit exceeded - potential spam', [
                'ip' => request()->ip(),
                'submissions' => $recentSubmissions,
                'email' => $this->email,
            ]);

            $this->showError = true;
            $this->errorMessage = 'Too many submissions. Please wait a few minutes before trying again.';
            throw new \Exception('Rate limit exceeded');
        }

        // Check for suspicious content (XSS attempts)
        $suspiciousPatterns = [
            '/<script/i',
            '/<iframe/i',
            '/javascript:/i',
            '/onclick=/i',
            '/onerror=/i',
            '/<embed/i',
            '/<object/i',
        ];

        $content = $this->name . ' ' . $this->interest;

        foreach ($suspiciousPatterns as $pattern) {
            if (preg_match($pattern, $content)) {
                Log::warning('Suspicious content detected', [
                    'ip' => request()->ip(),
                    'email' => $this->email,
                    'pattern' => $pattern,
                ]);

                $this->showError = true;
                $this->errorMessage = 'Invalid content detected. Please remove any HTML or scripts.';
                throw new \Exception('Suspicious content detected');
            }
        }
    }

    public function hideSuccess()
    {
        $this->showSuccess = false;
    }

    public function hideError()
    {
        $this->showError = false;
        $this->errorMessage = '';
    }

    public function resetForm()
    {
        $this->reset(['name', 'email', 'phone', 'persons', 'showSuccess', 'showError', 'errorMessage']);
        $this->interest = 'Serengeti National Park tour';
        $this->resetValidation();
    }

    #[Title('About Us - Rorena Tours')]
    public function render()
    {
        return view('livewire.pages.about', [
            'aboutUs' => $this->aboutUs,
            'teamMembers' => $this->teamMembers,
            'statistics' => $this->statistics,
        ])->layout('layouts.about');
    }
}
