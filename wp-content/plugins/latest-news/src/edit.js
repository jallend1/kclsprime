import { __ } from "@wordpress/i18n";
import { useSelect } from "@wordpress/data";
import "./editor.scss";
import { sanitize } from "dompurify";

export default function Edit() {
	const posts = useSelect((select) => {
		return select("core").getEntityRecords("postType", "post");
	}, []);

	return (
		<div className="local1857-recent-news-block">
			<div className="local1857-voice-editor-news-container">
				{!posts && "Loading"}
				{posts && posts.length === 0 && "No Posts"}
				{/* Slices the latest five blog entries and renders them into the editor */}
				{posts && posts.length > 0
					? posts.slice(0, 5).map((post, index) => {
							return (
								<div class="local1857-voice-editor-news">
									<h3 className="local1857-recent-news-editor-heading">
										{post.title.rendered}
									</h3>
									{index === 0 && (
										<p
											className="local1857-recent-news-editor-excerpt"
											dangerouslySetInnerHTML={{
												__html: sanitize(post.excerpt.rendered),
											}}
										></p>
									)}
								</div>
							);
					  })
					: null}
			</div>
			<div className="local1857-editor-news-overlay">
				<h3>
					This dynamically pulls the five most recent blog posts, and is not
					editable.
				</h3>
			</div>
		</div>
	);
}
