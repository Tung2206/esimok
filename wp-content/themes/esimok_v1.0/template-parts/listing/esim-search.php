<?php
/*
 * HTML Shortcode: VNB esim search
 *
 * @author tungnt (tungnt@vietnamdiscovery.com)
 * @since 2023-11-15
 *
 * @package Esimok
 * @version 1.0.52
 */

// Load Libs
wp_enqueue_script('gigago-vn-third-party-react');
wp_enqueue_script('gigago-vn-third-party-react-dom');
wp_enqueue_script('gigago-vn-third-party-react-babel');
wp_enqueue_script('gigago-vn-third-party-react-autosuggest');

// Load CSS
wp_enqueue_style('gigago-vn-listing-esim-search');

// Load JS
wp_enqueue_script('gigago-vn-listing-data-esim');

$app_id = uniqid();
?>
<div class="gigago-box-search">
    <script type="text/babel">
        $(document).ready(function () {
            // Your data, replace this with your actual data
            const data = <?php echo json_encode(get_option('gigago_suggestions', true)); ?>;
            const url = '/vnb-data/media/flag/';

            function escapeRegexCharacters(str) {
                return str.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
            }

            function getSuggestions(value) {
                const escapedValue = escapeRegexCharacters(value.normalize('NFD').replace(/[\u0300-\u036f]/g, '').replace(/đ/g, 'd').replace(/Đ/g, 'D').trim());

                const regex = new RegExp(escapedValue, 'i');

                const filteredLanguages = (data || []).map(section => {
                    return {
                        title: section.title,
                        image_url: section.image_url,
                        category_link:section.category_link,
                    };
                });

                const suggestions = filteredLanguages.filter(section => regex.test(section.title));

                return suggestions;
            }

            function getSuggestionValue(suggestion) {
                return suggestion.title;
            }

            function renderSuggestion(suggestion) {
                return (
                    <div className="product-block-search">
                        <div className="product-image-search">
                            {/* Replace this with your actual code to display the image */}
                            <img className='m-auto' src={suggestion.image_url || '<?php echo ESIMOK_THEME_URL ?>/assets/images/esimok-logo.svg'} alt="language" />
                        </div>
                        <div className="product-caption-search">
                            <h4 className="product-title-search">{suggestion.title}</h4>
                        </div>
                        <a href={suggestion.category_link || '#'}></a>
                    </div>
                );
            }

            function renderSectionTitle(section) {
                return (
                    <span>{section.title}</span>
                );
            }

            function getSectionSuggestions(section) {
                return section.languages;
            }

            function renderSuggestionsContainer({ containerProps, children, query }) {
                return (
                    <div {...containerProps}>
                        {children}
                        <div>
                            Press Enter to search <strong>{query}</strong>
                        </div>
                    </div>
                );
            }

            class App extends React.Component {
                constructor() {
                    super();

                    this.state = {
                        value: '',
                        suggestions: [],
                        noSuggestions: false,
                    };
                }

                onChange = (event, { newValue }) => {
                    this.setState({
                        value: newValue,
                    });
                };

                onSuggestionsFetchRequested = ({ value }) => {
                    const suggestions = getSuggestions(value);
                    const isInputBlank = value.trim() === '';
                    const noSuggestions = !isInputBlank && suggestions.length === 0;

                    this.setState({
                        suggestions,
                        noSuggestions,
                    });
                };

                onSuggestionsClearRequested = () => {
                    this.setState({
                        suggestions: [],
                    });
                };

                render() {
                    const { value, suggestions, noSuggestions } = this.state;

                    const inputProps = {
                        placeholder: "<?php echo esc_html__('Where do you want to travel next?', 'vnbwptheme'); ?>",
                        value,
                        onChange: this.onChange,
                    };

                    return (
                        <div>
                            <Autosuggest
                                multiSection={false}
                                suggestions={suggestions}
                                onSuggestionsFetchRequested={this.onSuggestionsFetchRequested}
                                onSuggestionsClearRequested={this.onSuggestionsClearRequested}
                                getSuggestionValue={getSuggestionValue}
                                alwaysRenderSuggestions={true}
                                renderSuggestion={renderSuggestion}
                                renderSectionTitle={renderSectionTitle}
                                getSectionSuggestions={getSectionSuggestions}
                                inputProps={inputProps}
                            />
                            {noSuggestions && (
                                <div className="no-suggestions on-focus">
                                    <?php echo esc_html__('No search results found, please try again', 'vnbwptheme'); ?>
                                </div>
                            )}
                        </div>
                    );
                }
            }

            ReactDOM.render(<App />, document.getElementById('esim-search-<?php echo esc_attr($app_id); ?>'));
        });
    </script>
    <div id="esim-search-<?php echo esc_attr($app_id); ?>" class="esim-search"></div>
    <div className="gigago-overlay"></div>
</div>