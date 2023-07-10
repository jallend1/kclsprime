import { __ } from "@wordpress/i18n";
import { useEntityRecords } from "@wordpress/core-data";
import { Spinner } from "@wordpress/components";
import "./editor.scss";
import { sanitize } from "dompurify";
import local1857Logo from "../local1857logo.png";

export default function Edit() {

	const posts = useEntityRecords("postType", "post", {
		per_page: 5,
	});

	const FeaturedImage = ({ attachmentID }) => {
		const page = useEntityRecords("postType", "attachment", {
			include: [attachmentID],
		});

		if(!page.hasResolved) {
			return <Spinner />
		}
		return <img src={page.records[0].source_url} alt="Featured Image" />;
	};

	const RetrievingPosts = () => {
		return (
			<div className="local1857-loading-posts">
				<h2>Retrieving Posts...</h2>
				<Spinner />
			</div>
		)
	}

	return (
		<div className="local1857-recent-news-block">
			<div className="local1857-voice-editor-news-container">
				{!posts.hasResolved && <RetrievingPosts />}
				{posts.records && posts.records.length === 0 && "No Posts"}
				{posts.hasResolved && posts.records.length > 0
					? posts.records.slice(0, 5).map((post, index) => {							
							return (
								<div class="local1857-voice-editor-news">
									<header>
										<div className="local1857-news-image">										
											{post.featured_media !== 0 && (
												<FeaturedImage attachmentID={post.featured_media} />
											)}
											{/* If post does not have featured_media, display local1857logo.png from the current folder*/}
											{post.featured_media === 0 && (
												<img
													src={local1857Logo}
													alt="Local 1857 Logo"
												/>
											)}
										</div>
									</header>
									<h3 className="local1857-recent-news-editor-heading">
										{post.title.rendered}
									</h3>
										<p
											className="local1857-recent-news-editor-excerpt"
											dangerouslySetInnerHTML={{
												__html: sanitize(post.excerpt.rendered),
											}}
										></p>
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
