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
            var gigago_suggestions = JSON.parse(window.localStorage.getItem('gigago_suggestions'));
            var languages = JSON.parse(window.localStorage.getItem('gigago_suggestions'));
            const url = '/vnb-data/media/flag/';
            if (gigago_suggestions) {
                var gigago_suggestions_version = JSON.parse(window.localStorage.getItem('gigago_suggestions_version'));
                var suggestions_version_temp = '<?= get_option('gigago_suggestions_version', true); ?>';
                if (gigago_suggestions_version === suggestions_version_temp) {
                    var languages = JSON.parse(window.localStorage.getItem('gigago_suggestions'));
                } else {
                    var suggestions_temp = <?= json_encode(get_option('gigago_suggestions', true)); ?>;
                    var languages = <?= json_encode(get_option('gigago_suggestions', true)); ?>;
                    localStorage.setItem('gigago_suggestions', JSON.stringify(suggestions_temp));
                    localStorage.setItem('gigago_suggestions_version', JSON.stringify(suggestions_version_temp));
                }

            } else {
                var suggestions_temp = <?= json_encode(get_option('gigago_suggestions', true)); ?>;
                var suggestions_version_temp = '<?= get_option('gigago_suggestions_version', true); ?>';
                var languages = <?= json_encode(get_option('gigago_suggestions', true)); ?>;
                localStorage.setItem('gigago_suggestions', JSON.stringify(suggestions_temp));
                localStorage.setItem('gigago_suggestions_version', JSON.stringify(suggestions_version_temp));
            }

            // search
            // https://developer.mozilla.org/en/docs/Web/JavaScript/Guide/Regular_Expressions#Using_Special_Characters
            function escapeRegexCharacters(str) {
                return str.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
            }

            function getSuggestions(value) {
                const escapedValue = escapeRegexCharacters(value.normalize('NFD').replace(/[\u0300-\u036f]/g, '').replace(/đ/g, 'd').replace(/Đ/g, 'D').trim());

                // if (escapedValue === '') {
                //     return [];
                // }

                const regex = new RegExp(escapedValue, 'i');

                return languages
                    .map(section => {
                        return {
                            title: section.title,
                            languages: section.product.filter(
                                language => regex.test(language.search_suggest))
                        };
                    })
                    .filter(section => section.languages.length > 0);
            }

            function getSuggestionValue(suggestion) {
                return suggestion.name_product;
            }

            function renderSuggestion(suggestion) {
                return (
                    <div className="product-block-search">
                        <div className="product-image-search">
                            <img className='m-auto ' src={`${url}${suggestion.country_code}${".png"}`} alt="language"/>
                        </div>
                        <div className="product-caption-search">
                            <h4 className="product-title-search">{suggestion.name}</h4>
                            <div className="product-price-search">
                                <span><?php echo esc_html__('From ', 'vnbwptheme')?> </span>
                                <span className="primary">{suggestion.price}</span>
                            </div>
                        </div>
                        <a href={suggestion.url}></a>
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

            function renderSuggestionsContainer({containerProps, children, query}) {
                return (
                    <div {...containerProps}>
                        {children}
                        <div>
                            Press Enter to search <strong>{query}</strong>
                        </div>
                    </div>
                );
            }

            // Lớp React Component chính của ứng dụng
            class App extends React.Component {
                // Constructor của lớp, khởi tạo state
                constructor() {
                    super();

                    this.state = {
                        value: '', // Giá trị đang nhập vào ô tìm kiếm
                        suggestions: [], // Danh sách gợi ý
                        noSuggestions: false // Biến kiểm tra có gợi ý hay không
                    };
                }

                // Xử lý sự kiện thay đổi giá trị đang nhập
                onChange = (event, {newValue, method}) => {
                    this.setState({
                        value: newValue
                    });
                };
                // Xử lý sự kiện lấy gợi ý dựa trên giá trị đang nhập
                onSuggestionsFetchRequested = ({value}) => {
                    const suggestions = getSuggestions(value);
                    const isInputBlank = value.trim() === '';
                    const noSuggestions = !isInputBlank && suggestions.length === 0;

                    this.setState({
                        suggestions,
                        noSuggestions
                    });
                };
                // Xử lý sự kiện xóa gợi ý
                onSuggestionsClearRequested = () => {
                    this.setState({
                        suggestions: []
                    });
                };

                // Phương thức render của Component
                render() {
                    const {value, suggestions, noSuggestions} = this.state;
                    // Các thuộc tính đầu vào của hộp tìm kiếm
                    const inputProps = {
                        placeholder: "<?php echo esc_html__('Where do you want to travel next?', 'vnbwptheme'); ?>",
                        value,
                        onChange: this.onChange
                    };

                    return (
                        <div>
                            <Autosuggest
                                multiSection={true}
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
                            {
                                noSuggestions &&
                                <div className="no-suggestions on-focus">
                                    <?php echo esc_html__('No search results found, please try again', 'vnbwptheme'); ?>
                                </div>
                            }
                        </div>
                    );
                }
            }

            ReactDOM.render(<App/>, document.getElementById('esim-search-<?= $app_id; ?>'));

        });
    </script>
    <div id="esim-search-<?php echo esc_attr($app_id); ?>" class="esim-search"></div>
    <div class="gigago-overlay"></div>
</div>